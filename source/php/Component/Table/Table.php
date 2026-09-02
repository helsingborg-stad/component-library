<?php

namespace ComponentLibrary\Component\Table;

class Table extends \ComponentLibrary\Component\BaseController
{
    public function init()
    {
        //Extract array for easy access (fetch only)
        extract($this->data);

        $this->padCells();

        //Typecast labels
        if(is_object($labels)) {
           $this->data['labels'] = (array) $labels; 
        }

        $this->data['attributeList']['data-js-table'] = true; 

        if ($filterable) {
            $this->data['attributeList']['data-js-table-filter'] = true;
        }

        if ($sortable) {
            $this->data['attributeList']['data-js-table-sort'] = true;
            $this->data['classList'][] = $this->getBaseClass() . '--sortable';
        }

        if ($async) {
            $this->data['attributeList']['data-js-table-async'] = true;
        }

        if ($isMultidimensional) {
            $this->data['classList'][]  = $this->getBaseClass() . '--multidimensional';
        }

        if($fullscreen && empty($title)) {
            $this->data['classList'][] = $this->getBaseClass() . '--title-none';
        }

        if ($showSum) {
            $this->data['classList'][]  = $this->getBaseClass() . '--summary';

            $sumRow = ['columns' => []];
            foreach ($list as $rowIndex => $row) {
                foreach ($row['columns'] as $cellIndex => $cell) {
                    if ($cellIndex !== 0) {
                        if (!isset($sumRow['columns'][$cellIndex])) {
                            $sumRow['columns'][$cellIndex] = (int)$cell;
                        } else {
                            $sumRow['columns'][$cellIndex] += (int)$cell;
                        }
                    }
                }
            }

            if ($list[count($list) - 1]['columns'][0] !== 'Sum') {
                array_unshift($sumRow['columns'], 'Sum');
                array_push($list, $sumRow);
            }

            $this->data['list'] = $list;
        }
    }

    /**
     * Traverse the arrays and make
     * each sub array equal in length
     *
     * @return void
     */
    private function padCells()
    {
        $longest = 0;
        foreach ($this->data['list'] as $row) {
            $current = count($row['columns']);
            if ($current > $longest) {
                $longest = $current;
            }
        }

        foreach ($this->data['list'] as &$row) {
            $row['columns'] = array_pad($row['columns'], $longest, ' ');
        }
    }
}