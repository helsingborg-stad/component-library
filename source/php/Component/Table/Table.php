<?php

namespace ComponentLibrary\Component\Table;

class Table extends \ComponentLibrary\Component\BaseController  
{
    
    public function init() {
        $this->padCells();
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

    private function padCells() {
        $longest = 0;
        foreach($this->data['list'] as $row) {
            $current = count($row['columns']);
            if($current > $longest) {
                $longest = $current;
            }

        }

        foreach($this->data['list'] as &$row) {
            
            $row['columns'] = array_pad($row['columns'], $longest, ' ');
            

        }
    }
}