<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once("Report.php");

class Brand_inventory extends Report
{
    public function getDataColumns()
    {
        return array(
            array('manufacturer' => 'Manufacturer'),
            array('item_id' => 'Item ID'),
            array('item_name' => $this->lang->line('reports_item_name')),
            array('category' => $this->lang->line('reports_category')),
            array('quantity' => $this->lang->line('reports_quantity')),
            array('reorder_level' => $this->lang->line('reports_reorder_level')),
            array('location_name' => $this->lang->line('reports_stock_location')),
            array('pack_price' => "Pack Price", 'sorter' => 'number_sorter'),
            array('unit_price' => "Unit Price", 'sorter' => 'number_sorter'),
            array('subtotal' => $this->lang->line('reports_sub_total_value'), 'sorter' => 'number_sorter')
        );
    }

    public function getData(array $inputs)
    {
        #get location name
        $query = $this->db->query("Select * from ospos_stock_locations where location_id=" . $inputs['location_id']);
        $row = $query->row_array();
        if (isset($row))
        {
            $location_name = $row['location_name'];
        }else{
            $location_name = "Unknown";
        }

        #get data based on location
        $query = $this->db->query("SELECT 
            av.attribute_value as manufacturer, 
			i.item_id, 
            i.name,
            i.receiving_quantity, 
            i.category, 
            iq.quantity, 
            i.reorder_level, 
            '" . $location_name . "' as location_name, 
            i.pack_price, 
            i.unit_price, 
            (i.unit_price * iq.quantity) AS sub_total_value
			FROM ospos_items AS i

            LEFT JOIN ospos_item_quantities iq on i.item_id = iq.item_id
            LEFT JOIN ospos_attribute_links al ON al.item_id = i.item_id
            LEFT JOIN ospos_attribute_values av ON av.attribute_id = al.attribute_id
            LEFT JOIN ospos_stock_locations sl ON iq.location_id = sl.location_id AND sl.deleted=0 AND sl.location_id = " . $inputs['location_id'] . "

            WHERE i.deleted=0 AND i.stock_type=0 
            GROUP BY i.item_id
            order BY manufacturer, i.name, i.receiving_quantity");

		return $query->result_array();
    }

    /**
     * calculates the total value of the given inventory summary by summing all sub_total_values (see Inventory_summary::getData())
     *
     * @param array $inputs expects the reports-data-array which Inventory_summary::getData() returns
     * @return array
     */
    public function getSummaryData(array $inputs)
    {
        $return = array('total_retail' => 0);
        //$return = array('total_quantity' => 0, 'total_inventory_value' => 0, 'total_retail' => 0);

        foreach ($inputs as $input) {
            //$return['total_quantity'] += $input['quantity'];
            //$return['total_inventory_value'] += $input['sub_total_value'];
            //$return['total_low_sell_quantity'] += $input['low_sell_quantity'];
            $return['total_retail'] += $input['unit_price'] * $input['quantity'];
        }

        return $return;
    }

    /**
     * returns the array for the dropdown-element item-count in the form for the inventory summary-report
     *
     * @return array
     */
    public function getItemCountDropdownArray()
    {
        return array(
            'all' => $this->lang->line('reports_all'),
            'zero_and_less' => $this->lang->line('reports_zero_and_less'),
            'more_than_zero' => $this->lang->line('reports_more_than_zero')
        );
    }
}
?>