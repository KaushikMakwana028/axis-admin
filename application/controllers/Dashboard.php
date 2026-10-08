<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('is_admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login to access the admin dashboard.');
            redirect('login');
        }
    }

    /**
     * Helper to format bytes into readable units
     */
    private function format_bytes($bytes, $precision = 1)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max((float)$bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function index()
    {
        $data['title'] = 'Dashboard';

        // Catalog statistics
        $data['total_categories'] = (int)$this->General_model->getCount('categories');
        $data['active_categories'] = (int)$this->General_model->getCount('categories', ['status' => 1]);
        $data['total_subcategories'] = (int)$this->General_model->getCount('subcategories');
        $data['active_subcategories'] = (int)$this->General_model->getCount('subcategories', ['status' => 1]);
        $data['total_file_types'] = (int)$this->General_model->getCount('file_types');
        $data['active_file_types'] = (int)$this->General_model->getCount('file_types', ['status' => 1]);
        $data['total_products'] = (int)$this->General_model->getCount('products');
        $data['active_products'] = (int)$this->General_model->getCount('products', ['status' => 1]);
        $data['inactive_products'] = max(0, $data['total_products'] - $data['active_products']);

        // Storage & Digital files statistics
        $storage_query = $this->db->select('COUNT(id) as total_files, COALESCE(SUM(file_size), 0) as total_bytes')
            ->get('product_files')
            ->row();
        $total_files = $storage_query ? (int)$storage_query->total_files : 0;
        $total_bytes = $storage_query ? (float)$storage_query->total_bytes : 0;
        $data['total_files'] = $total_files;
        $data['total_storage_formatted'] = $this->format_bytes($total_bytes);
        $data['total_storage_bytes'] = $total_bytes;

        // Chart Data 1: Products per Category
        $cat_chart_query = $this->db->query("
            SELECT c.name, COUNT(p.id) as product_count
            FROM categories c
            LEFT JOIN products p ON p.category_id = c.id
            GROUP BY c.id
            ORDER BY product_count DESC, c.name ASC
            LIMIT 7
        ")->result();
        $cat_labels = [];
        $cat_counts = [];
        foreach ($cat_chart_query as $row) {
            $cat_labels[] = $row->name;
            $cat_counts[] = (int)$row->product_count;
        }
        $data['cat_labels'] = $cat_labels;
        $data['cat_counts'] = $cat_counts;

        // Chart Data 2: File Formats Distribution
        $format_chart_query = $this->db->query("
            SELECT ft.name, ft.extension, COUNT(pf.id) as file_count
            FROM file_types ft
            LEFT JOIN product_files pf ON pf.file_type_id = ft.id
            GROUP BY ft.id
            ORDER BY file_count DESC, ft.name ASC
        ")->result();
        $format_labels = [];
        $format_counts = [];
        $format_extensions = [];
        foreach ($format_chart_query as $row) {
            $format_labels[] = strtoupper(ltrim($row->extension, '.')) . ' (' . $row->name . ')';
            $format_extensions[] = strtoupper(ltrim($row->extension, '.'));
            $format_counts[] = (int)$row->file_count;
        }
        $data['format_labels'] = $format_labels;
        $data['format_extensions'] = $format_extensions;
        $data['format_counts'] = $format_counts;
        $data['top_formats'] = $format_chart_query;

        // Recent Products with joined categories and attached formats
        $this->db->select('p.*, c.name as category_name, s.name as subcategory_name');
        $this->db->from('products p');
        $this->db->join('categories c', 'c.id = p.category_id', 'left');
        $this->db->join('subcategories s', 's.id = p.subcategory_id', 'left');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(5);
        $recent_products = $this->db->get()->result();

        foreach ($recent_products as $prod) {
            $prod->files = $this->db->select('pf.id, pf.file_name, pf.file_size, ft.extension, ft.name as format_name')
                ->from('product_files pf')
                ->join('file_types ft', 'ft.id = pf.file_type_id', 'left')
                ->where('pf.product_id', $prod->id)
                ->get()->result();
        }
        $data['recent_products'] = $recent_products;

        // Recent categories with product count
        $data['recent_categories'] = $this->db->query("
            SELECT c.*, (SELECT COUNT(id) FROM products WHERE category_id = c.id) as product_count
            FROM categories c
            ORDER BY c.id DESC
            LIMIT 5
        ")->result();

        // Recent subcategories with parent category
        $this->db->select('s.*, c.name as category_name');
        $this->db->from('subcategories s');
        $this->db->join('categories c', 'c.id = s.category_id', 'inner');
        $this->db->order_by('s.id', 'DESC');
        $this->db->limit(5);
        $data['recent_subcategories'] = $this->db->get()->result();

        $this->load->view('header_view', $data);
        $this->load->view('dashboard_view', $data);
        $this->load->view('footer_view');
    }
}
