<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
	
	public function getPaymentData($start_date, $end_date, $biller_id = null)
	{
		$this->db->select("
					payments.id as TransactionID,
					sales.reference_no as InvoiceID,
					payments.reference_no as ReceiptID,
					payments.date as Date,
					sales.date as StartTime,
					sales.date as EndTime,
					sales.queue as NumberOfCustomer,
					sales.total as SubTotal,
					sales.order_discount as DiscountDollar,
					(erp_sales.order_discount * erp_sales.other_cur_paid_rate) as DiscountRiel,
					sales.order_discount_id as DiscountTypeID,
					SUM(erp_return_sales.grand_total) as ReturnAmount,
					SUM(erp_return_sales.paid) as RefundAmount,
					sales.order_tax as Vat,
					(erp_sales.grand_total - erp_sales.order_tax) as Net,
					sales.grand_total as GrandTotal,
					payments.pos_paid as PaymentDollar,
					payments.pos_paid_other as PaymentRiel,
					payments.pos_balance as ChangeDollar,
					(erp_payments.pos_balance * erp_payments.pos_paid_other_rate) as ChangeRiel,
					payments.bank_account as PaymentMethodId,
					CONCAT(erp_users.first_name, ' ', erp_users.last_name) as Cashier,
					sales.payment_status as StatusId,
					payments.note as Comment,
					payments.pos_paid_other_rate as ExchangeRate
		");
		$this->db->join('users', 'users.id = payments.created_by');
		$this->db->join('sales', 'sales.id = payments.sale_id');
		$this->db->join('return_sales', 'sales.id = return_sales.sale_id', 'left');
		$this->db->where('payments.sale_id <>', null);
		$this->db->where('payments.date >=', $start_date);
		$this->db->where('payments.date <=', $end_date);
		if($biller_id) {
			$this->db->where('payments.biller_id', $biller_id);
		}
		$this->db->group_by('payments.id, payments.sale_id');
		$q = $this->db->get('payments');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
				$row->Currency = $this->Settings->default_currency;
                $data[] = $row;
            }
            return $data;
        }
        return FALSE;
	}
	
}