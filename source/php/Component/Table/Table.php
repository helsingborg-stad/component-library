<?php

namespace ComponentLibrary\Component\Table;

class Table extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if($filterable) {
            $this->data['attributeList']['js-table-filter'] = '';
        }

        if($sortable) {
            $this->data['attributeList']['js-table-sort'] = '';
        }

        if($pagination) {
            $this->data['attributeList']['js-table-pagination'] = $pagination;
            $this->data['attributeList']['js-table-pagination--current'] = 1;
        }
        
        if($collapsible) {
            $this->data['attributeList']['js-table-collapsible'] = true;
        }

        if($isMultidimensional) {
            $this->data['classList'][]  = $this->getBaseClass() . '--multidimensional';
        }

        if($boxShadow) {
            $this->data['classList'][]  = $this->getBaseClass() . '--box-shadow';
        }

        if($showSum) {
            $this->data['attributeList']['table-sum'] = true;

            $sumRow = ['columns' => []];
            foreach($list as $rowIndex => $row) {
                
                foreach($row['columns'] as $cellIndex => $cell) {
                    if($cellIndex !== 0) {
                        if(!isset($sumRow['columns'][$cellIndex])) {
                            $sumRow['columns'][$cellIndex] = (int)$cell;
                        } else {
                            $sumRow['columns'][$cellIndex] += (int)$cell;
                        }
                    }
                }
            }            
            
            

            if($list[count($list) - 1]['columns'][0] !== 'Sum') {
                array_unshift($sumRow['columns'], 'Sum');
                array_push($list,$sumRow);
            }

            $this->data['list'] = $list;
        }        
    }
}