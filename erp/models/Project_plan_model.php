<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Project_plan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

	public function getProductNames($term, $standard, $combo, $digital, $service, $category, $limit = 20)
    {
        
		$this->db->where("(type = 'standard' OR type = 'service') AND (name LIKE '%" . $term . "%' OR code LIKE '%" . $term . "%' OR  concat(name, ' (', code, ')') LIKE '%" . $term . "%') AND inactived <> 1");
		if(!$this->Owner || !$this->Admin){
            if($standard != ""){
                $this->db->where("products.type <> 'standard' ");
            }
            if($combo != ""){
                $this->db->where("products.type <> 'combo' ");
            }
            if($digital != ""){
                $this->db->where("products.type <> 'digital' ");
            }
            if($service != ""){
                $this->db->where("products.type <> 'service' ");
            }
            if($category != ""){
                $this->db->where("products.category_id NOT IN (".$category.") ");
            }
		}
		$this->db->order_by('code', 'ASC');
        $this->db->limit($limit);
        $q = $this->db->get('products');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	
	public function getProductOptions($product_id)
    {
        $q = $this->db->get_where('product_variants', array('product_id' => $product_id));
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
    }
	
	public function addProjectPlan($data, $items){
		if ($this->db->insert('project_plan', $data)) {
			$plan_id = $this->db->insert_id();
			if ($this->site->getReference('pn',$data['biller_id']) == $data['reference_no']) {
				$this->site->updateReference('pn',$data['biller_id']);
			}
			foreach ($items as $item) {
				$item['project_plan_id'] = $plan_id;
				$this->db->insert('project_plan_items', $item);
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function updateProjectPlan($id, $data, $items){
		if ($this->db->update('project_plan', $data)) {
			$this->db->delete('project_plan_items', array('project_plan_id' => $id));
			foreach ($items as $item) {
				$item['project_plan_id'] = $id;
				$this->db->insert('project_plan_items', $item);
			}
			return true;
		} else {
			return false;
		}
	}
	
	public function getProductVariant($id){
		$q = $this->db->get_where('product_variants', array('id' => $id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
	}
	
	public function getAllProjectPlan($id){
		$q = $this->db->get_where('project_plan', array('id' => $id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
	}
	
	public function getAllProjectPlanItem($id){
		$q = $this->db->get_where('project_plan_items', array('project_plan_id' => $id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        return FALSE;
	}
	
	public function getPlan($id){
		$q = $this->db->get('project_plan');
        if ($q->num_rows() > 0) {
            return $q->result();
        }
        return FALSE;
	}
	
	public function addProjectAddress($data){
		if ($this->db->insert('plan_address', $data)) {
			return true;
		} else {
			return false;
		}
	}
	
}
