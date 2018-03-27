<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
* Script: pos_lang.php
*   English translation file
*
 * Last edited:
 * 30th April 2015
 *
 * Package:
 * iCloudERP - POS v3.0
 * 
 * You can translate this file to your language. 
 * For instruction on new language setup, please visit the documentations. 
 * You also can share your language files by emailing to icloud.erp@gmail.com 
 * Thank you 
 */

// For quick cash buttons -  if you need to format the currency please do it according to you system settings
$lang['quick_cash_notes']               = array('10', '20', '50', '100', '500', '1000', '5000');

$lang['biller']                 					= "Project";
$lang['pos_module']                     	= "POS Module";
$lang['cat_limit']                      		= "Display Categories";
$lang['pro_limit']                      		= "Display Products";
$lang['default_category']               	= "Default Category";
$lang['default_customer']               	= "Default Customer";
$lang['default_biller']                 		= "Default Project";
$lang['pos_settings']                   	= "POS Settings";
$lang['barcode_scanner']                	= "Barcode Scanner";
$lang['x']                              			= "X";
$lang['qty']                            			= "Qty";
$lang['total_items']                    		= "Total Items";
$lang['total_payable']                  	= "Total Payable";
$lang['total_sales']                    		= "Total Sales";
$lang['tax1']                           		= "Tax 1";
$lang['are_you_sure_want_to_sale_it']   = "Are you sure want to sale it?";
$lang['total_x_tax']                    		= "Total";
$lang['trea_try_II']                    	    = "Trea Try II";
$lang['bill_nº']                         		= "Bill Nº";
$lang['cancel']                         		= "Cancel";
$lang['payment']                        		= "Payment";
$lang['quantity_in_hand']                       = "Quantity In Hand";
$lang['quantity_order']                       = "Quantity Order";
$lang['pos']                            		= "POS";
$lang['queue']                            		= "Queue";
$lang['p_o_s']                          		= "Point of Sale";
$lang['today_sale']                     		= "Today's Sale";
$lang['daily_sales']                    		= "Daily Sales";
$lang['monthly_sales']                  	= "Monthly Sales";
$lang['pos_settings']                   	= "POS Settings";
$lang['loading']                        		= "Loading...";
$lang['display_time']                   	= "Display Time";
$lang['pos_setting_updated']            = "POS settings successfully updated";
$lang['pos_setting_updated_payment_failed'] = "POS settings successfully saved but payment gateways settings failed. Please try again";
$lang['tax_request_failed']             	= "Request Failed, There is some problem with tax rate!";
$lang['pos_error']                      		= "An error occurred in the calculation. Please add products again. Thank you!";
$lang['qty_limit']                      		= "You have reached the quantity limit 999.";
$lang['max_pro_reached']                	= "Max Allowed Reached! Please add payment for this and open new bill for all next items. Thank you!";
$lang['code_error']                     		= "Request Failed, Please check your code and try again!";
$lang['x_total']                        		= "Please add product before payment. Thank you!";
$lang['paid_l_t_payable']               	= "Paid amount is less than the payable amount. Please press OK to submit the sale.";
$lang['paid_l_t_payable_amount']  	= "Paid amount is less than the payable amount.";
$lang['suspended_sales']                	= "Room|Table Sales";
$lang['sale_suspended']                 	= "Sale Successfully Room|Table.";
$lang['sale_suspend_failed']            	= "Room|Table Sale Failed. Please try again!";
$lang['add_to_pos']                     	= "Add this sale to pos screen";
$lang['delete_suspended_sale']     	= "Delete this suspended sale";
$lang['save']                           		= "Save";
$lang['discount_request_failed']        = "Request Failed, There is some problem with discount!";
$lang['saving']                         		= "Saving...";
$lang['paid_by']                        		= "Paid by";
$lang['paid']                           		= "Paid";
$lang['ajax_error']                    		= "Request Failed, Please try again!";
$lang['close']                          		= "Close";
$lang['finalize_sale']                  		= "Finalize Sale";
$lang['cash_sale']                      		= "Cash Payment";
$lang['cc_sale']                        		= "Credit Card Payment";
$lang['ch_sale']                        		= "Cheque Payment";
$lang['sure_to_suspend_sale']    		= "Are you sure you want to suspend Sale?";
$lang['leave_alert']                    		= "You will lose sale data. Press OK to leave and Cancel to Stay on this page.";
$lang['sure_to_cancel_sale']            	= "Are you sure you want to Cancel Sale?";
$lang['sure_to_submit_sale']            = "Are you sure you want to Submit Sale?";
$lang['alert_x_sale']                   		= "Are you sure you want to delete this suspended sale?";
$lang['suspended_sale_deleted'] 		= "Room|Table sale successfully deleted";
$lang['item_count_error']               	= "An error occurred while counting the total items. Please try again!";
$lang['x_suspend']                      	= "Please add product before suspending the sale. Thank you!";
$lang['x_cancel']                       		= "There is no product. Thank you!";
$lang['yes']                            		= "Yes";
$lang['no1']                            		= "No";
$lang['suspend']                        		= "Room|Table";
$lang['order_list']                     		= "Order List";
$lang['print']                          			= "Print";
$lang['print_bill']                     		= "Print Bill";
$lang['print_order']                    		= "Print Order";
$lang['cf_display_on_bill']             	= "Custom Field to display on pos receipt";
$lang['cf_title1']                     			= "Custom Field 1 Title";
$lang['cf_value1']                      		= "Custom Field 1 Value";
$lang['cf_title2']                      		= "Custom Field 2 Title";
$lang['cf_value2']                      		= "Custom Field 2 Value";
$lang['cash']                           		= "Cash";
$lang['cc']                             			= "Credit Card";
$lang['cheque']                         		= "Cheque";
$lang['cc_no']                          		= "Credit Card No";
$lang['cc_holder']                      		= "Holder Name";
$lang['cheque_no']                      	= "Cheque No";
$lang['email_sent']                     		= "Email successfully sent!";
$lang['email_failed']                   		= "Send email function failed!";
$lang['back_to_pos']                    	= "Back to POS";
$lang['shortcuts']                      		= "Shortcuts";
$lang['shortcut_key']                   	= "Shortcut Key";
$lang['shortcut_keys']                  	= "Shortcut Keys";
$lang['keyboard']                       		= "Keyboard";
$lang['onscreen_keyboard']              	= "On-Screen Keyboard";
$lang['focus_add_item']                 	= "Focus Add Item Input";
$lang['add_manual_product']         	= "Add Manual Item to Sale";
$lang['customer_selection']             	= "Customer Input";
$lang['toggle_category_slider']         	= "Toggle Categories Slider";
$lang['toggle_subcategory_slider'] 	= "Toggle Subcategories Slider";
$lang['cancel_sale']                    		= "Cancel Sale";
$lang['show_search_item']               	= "Show Search Item";
$lang['product_unit']                   		= "Product Unit";
$lang['suspend_sale']                   	= "Room|Table Sale";
$lang['print_items_list']               	= "Print items list";
$lang['finalize_sale']                  		= "Finalize Sale";
$lang['open_hold_bills']                	= "Open Room|Table Sales";
$lang['search_product_by_name_code']    = "Scan/Search product by name/code";
$lang['receipt_printer']                		= "Receipt Printer";
$lang['cash_drawer_codes']              = "Open Cash Drawer Code";
$lang['pos_list_printers']              	= "POS List Printers (Separated by |)";
$lang['custom_fileds']                  	= "Custom fields for receipt";
$lang['shortcut_heading']               	= "Ctrl, Shift and Alt with any other letter (Ctrl+Shift+A). Function keys (F1 - F12) are supported too.";
$lang['product_button_color']           	= "Product Button Color";
$lang['edit_order_tax']                 	= "Edit Order Tax";
$lang['select_order_tax']               	= "Select Order Tax";
$lang['paying_by']                      		= "Paying by";
$lang['paypal_pro']                     		= "Paypal Pro";
$lang['stripe']                         		= "Stripe";
$lang['swipe']                          		= "Swipe";
$lang['card_type']                      		= "Card Type";
$lang['Visa']                           		= "Visa";
$lang['MasterCard']                     		= "MasterCard";
$lang['Amex']                           		= "Amex";
$lang['Discover']                       		= "Discover";
$lang['month']                          		= "Month";
$lang['year']                           		= "Year";
$lang['cvv2']                           		= "Security Code";
$lang['total_paying']                  		= "Total Paying";
$lang['balance']                        		= "Balance";
$lang['serial_no']                      		= "Serial No";
$lang['product_discount']               	= "Product Discount";
$lang['max_reached']                    	= "Max allowed limit reached.";
$lang['add_more_payments']       		= "Add More Payments";
$lang['sell_gift_card']                 		= "Sell Member Card";
$lang['gift_card']                      		= "Member Card";
$lang['product_option']                 	= "Product Option";
$lang['card_no']                        		= "Card No";
$lang['value']                          		= "Value";
$lang['paypal']                         		= "Paypal";
$lang['sale_added']                     	= "POS Sale successfully added";
$lang['invoice']                        		= "Invoice";
$lang['vat']                            			= "VAT";
$lang['web_print']                      		= "Re-Print";
$lang['ajax_request_failed']            	= "Ajax request failed, pleas try again";
$lang['pos_config']                     		= "POS Configuration";
$lang['default']                        		= "Default";
$lang['primary']                        		= "Primary";
$lang['info']                           			= "Info";
$lang['warning']                        		= "Warning";
$lang['danger']                         		= "Danger";
$lang['enable_java_applet']             	= "Enable Java Applet";
$lang['update_settings']                	= "Update Settings";
$lang['open_register']                  	= "Open Register";
$lang['close_register']                 		= "Close Register";
$lang['cash_in_hand']                   	= "Cash in hand";
$lang['total_cash']                     		= "Total Cash";
$lang['total_cheques']                  	= "Total Cheques";
$lang['total_cc_slips']                 		= "Total Credit Card Slips";
$lang['CC']                             		= "Credit Card";
$lang['register_closed']                	= "Register successfully closed";
$lang['register_not_open']              	= "Register is not open, Please enter the cash in hand amount and click open register";
$lang['welcome_to_pos']                	= "Welcome to POS";
$lang['tooltips']                       		= "Tool tips";
$lang['previous']                       		= "Previous";
$lang['next']                           		= "Next";
$lang['payment_gateways']               = "Payment Gateways";
$lang['stripe_secret_key']              	= "Stripe Secret Key";
$lang['stripe_publishable_key']         = "Stripe Publishable Key";
$lang['APIUsername']                    	= "Paypal Pro API Username";
$lang['APIPassword']                    	= "Paypal Pro API Password";
$lang['APISignature']                   	= "Paypal Pro API Signature";
$lang['view_bill']                      		= "View Bill";
$lang['view_bill_screen']               	= "View Bill Screen";
$lang['opened_bills']                   		= "Opened Bills";
$lang['leave_opened']                   	= "Leave Opened";
$lang['delete_bill']                    		= "Delete Bill";
$lang['delete_all']                    		= "Delete All";
$lang['transfer_opened_bills']          	= "Transfer Opened Bills";
$lang['paypal_empty_error']             	= "Paypal transaction failed (Empty error array returned)";
$lang['payment_failed']                 	= "<strong>Payment Failed!</strong>";
$lang['pending_amount']                 	= "Pending Amount";
$lang['available_amount']               	= "Available Amount";
$lang['stripe_balance']                 	= "Stripe Balance";
$lang['paypal_balance']                 	= "Paypal Balance";
$lang['view_receipt']                   		= "View Receipt";
$lang['rounding']                       		= "Rounding";
$lang['ppp']                            		= "Paypal Pro";
$lang['delete_sale']                    		= "Delete Sale";
$lang['return_sale']                    		= "Return Sale";
$lang['edit_sale']                      		= "Edit Sale";
$lang['email_sale']                     		= "Email Sale";
$lang['add_delivery']                   		= "Add Delivery";
$lang['add_payment']                    	= "Add Payment";
$lang['view_payments']                  	= "View Payments";
$lang['no_meil_provided']               	= "No email address provided";
$lang['payment_added']                  	= "Payment successfully added";
$lang['suspend_sale']                   	= "Room|Table Sale";
$lang['reference_note']                 	= "Reference Note";
$lang['type_reference_note']            	= "Please type reference note and submit to suspend this sale";
$lang['change']                         		= "Change";
$lang['quick_cash']                     		= "Quick Cash";
$lang['sales_person']                   	= "Sales Associate";
$lang['no_opeded_bill']                 	= "No opened bill found";
$lang['please_update_settings']  		= "Please update the settings before using the POS";
$lang['order']                          		= "Order";
$lang['bill']                           			= "Bill";
$lang['due']                            		= "Due";
$lang['paid_amount']                    	= "Paid ";
$lang['paid_amount_us']                 	= "Paid (USD)";
$lang['paid_amount_kh']                 	= "Paid (KHM)";
$lang['due_amount']                     	= "Due Amount";
$lang['due_amount_kh']                  	= "Due Amount(KHM)";
$lang['due_amount_us']                  	= "Due Amount(USD)";
$lang['balanace_amount_kh']      		= "Balance (KHM)";
$lang['balance_amount_us']         		= "Balance (USD)";
$lang['change_amount_kh']          	= "Change (KHM)";
$lang['change_amount_us']           	= "Change (USD)";
$lang['edit_order_discount']            	= "Edit Order Discount";
$lang['sale_note']                     		= "Sale Note";
$lang['staff_note']                     		= "Staff Note";
$lang['list_open_registers']            	= "List Open Registers";
$lang['open_registers']                 	= "Open Registers";
$lang['opened_at']                      	= "Opened at";
$lang['all_registers_are_closed']       	= "All registers are closed";
$lang['review_opened_registers']   	= "Please review all opened registers in table below";
$lang['suspended_sale_loaded']      	= "Room|Table sale successfully loaded";
$lang['incorrect_gift_card']            	= "Member card number is incorrect or expired.";
$lang['gift_card_not_for_customer']  	= "Member card number is not for this customer.";
$lang['delete_sales']                   	= "Delete Sales";
$lang['click_to_add']                   		= "Please click the button below to open";
$lang['tax_summary']                    	= "Tax Summary";
$lang['qty']                            			= "Qty";
$lang['tax_excl']                       		= "Tax Excl";
$lang['tax_amt']                        		= "Tax Amt";
$lang['total_tax_amount']               	= "Total Tax Amount";
$lang['tax_invoice']                    		= "TAX INVOICE";
$lang['print_tax_invoice']              	= "PRINT TAX INVOICE";
$lang['char_per_line']                  		= "Characters per line";
$lang['delete_code']                    	= "POS Pin Code";
$lang['quantity_out_of_stock_for_%s']   = "The quantity is out of stock for %s";
$lang['refunds']                        		= "Refunds";
$lang['register_details']               	= "Register Details";
$lang['payment_note']                   	= "Payment Note";
$lang['to_nearest_005']                 	= "To nearest 0.05";
$lang['to_nearest_050']                 	= "To nearest 0.50";
$lang['to_nearest_number']              = "To nearest number (integer)";
$lang['to_next_number']                 	= "To next number (integer)";
$lang['update_heading']                 	= "This page will help you check and install the updates easily with single click. <strong>If there are more than 1 updates available, please update them one by one starting from the top (lowest version)</strong>.";
$lang['update_successful']              	= "Item successfully updated";
$lang['using_latest_update']            	= "You are using the latest version.";
$lang['depre_term']							= "Depreciation Team";
$lang['loan']									= "Loan";
$lang['exchange_rate']						= "Rate";
$lang['payment_balance']                	= "Allow Payment Less Balance";
$lang['show_payment_noted']         	= "Show Payment Noted";
$lang['display_qrcode']                 	= "Display QRcode";
$lang['show_suspend_bar']               = "Show Room|Table Bar";
$lang['item_photo']                     	= "Item Photo";
$lang['pos_layout']                			= "POS Layout";
$lang['stock']                 					= "Stock";
$lang['show_product_code']           	= "Show Product Code";
$lang['daily']          						= "Daily";
$lang['weekly']          			 			= "Weekly";
$lang['monthly']         			  			= "Monthly";
$lang['quarterly']         			  		= "Quarterly";
$lang['semesterly']         		  			= "Semesterly";
$lang['yearly']           						= "Yearly";
$lang['interest_rate_per_month']		= "Interest Rate/Month";
$lang['product_note']           			= "Product Note";
$lang['time_in']                        		= "Time In";
$lang['time_out']                       		= "Time Out";
$lang['print_receipt']						= "Print Receipt";
$lang['saleman']								= "Saleman";
$lang['free']						    		= "Free";
$lang['rate']						    		= "Rate";
$lang['standard']					    		= "Standard";
$lang['mart']						    		= "Mart";
$lang['mini_mart']							= "Mini Mart";
$lang['restaurant']					    	= "Restaurant";
$lang['currency']								= "Currency";
$lang['total_paid']							= "Total Paid";
$lang['remaining']							= "Remaining";
$lang['remaining_us']						= "Remaining (USD)";
$lang['remaining_kh']						= "Remaining (KHM)";
$lang['change']								= "Change";
$lang['save']								= "Save";
$lang['customer']							= "Customer";
$lang['start_date']							= "Start Date";
$lang['end_date']							= "End Date";
$lang['date_of_birth']						= "Date Of Birth";
$lang['in']									= "In";
$lang['out']								= "Out";
$lang["auto_delivery"]                 		= "Auto Delivery";
$lang["delivery_by"]						= "Delivery by";
$lang["standard_plus"]						= "Standard Plus";
$lang["floor"]								= "Floor";
$lang["table"]								= "Table";
$lang['qty']              					= "Qty";
$lang['restaurant_plus']					= "Restaurant Plus";
$lang['total_kh']							= "Total (KHM)";
$lang['price_kh']							= "Price (KHM)";
$lang['num_']								= "N<sup>o</sup>";
$lang['period']								= "Period";
$lang['percentage']							= "Percentage";
$lang['total_payment']						= "Total Payment";
$lang['dateline']							= "Dateline";
$lang['interest']							= "Interest";
$lang['principal']							= "Principle";
$lang['payment_date']						= "Payment Date";
$lang['rate_percentage']					= "Rate (%)";
$lang['term_months']						= "Term (Months)";
$lang['payment_type']						= "Payment Type";
$lang['normal']								= "Normal";
$lang['custom']								= "Custom";
$lang['fixed']								= "Fixed";
$lang['normal_fixed']						= "Normal (Fixed)";
$lang['depreciation_term']					= "Depreciation Term";
$lang['screen']								= "Screen";
$lang['expense']							= "Expense";
$lang['once_time']							= "Once Time";
$lang['kitchen']							= "Kitchen";
$lang['complete']							= "Complete";
$lang['principle_type']						= "Principle Type";
$lang['delivery_status']					= "Delivery Status";
$lang['quantity_received']					= "Quantity Received";
$lang['sale_reference_no']					= "Sale Reference No";
$lang['saleman_by']							= "Saleman By";
$lang['do_no']								= "Delivery No";
$lang['so_no']								= "SO No";
$lang['terminal']							= "Terminal";
$lang['partner']							= "Partner";
$lang['cust.name']							= "Customer";
$lang['ref_no']								= "Ref no.";
$lang['time']								= "Time";
$lang['items_name']							= "Items name";
$lang['order_food']							= "Order Food";
$lang['order_drink']						= "Order Drink";
$lang['voucher']							= "Voucher";
$lang['voucher_no']							= "Voucher No";
$lang['mm_sale']							= "Member Card";
// $lang['jones_the_grocer']					= "Jones the grocer";
$lang['voucher_sale']						= "Voucher";
$lang['total_voucher_slips']				= "Total Voucher Slip";
$lang['total_member_slips']					= "Total Member Card Slip";
$lang['siem_reap_store']						= "Siem Reap Store";
$lang['tax_id']										= "Tax ID : ";
$lang['invoice_num']										= "Invoice No";




