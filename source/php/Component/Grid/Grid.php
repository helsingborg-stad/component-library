<?php

namespace ComponentLibrary\Component\Grid;

class Grid extends \ComponentLibrary\Component\BaseController  
{
    public function init() {
        //Extract array for eazy access (fetch only)
        extract($this->data);

        if ($container) {
            $this->setContainer($columns, $min_width, $max_width);
        }

        if (isset($col)) {
            $this->setCols($col);
        }

        if (isset($row)) {
            $this->setRows($row);
        }

        $this->setGaps($col_gap, $row_gap);
    }

    /**
     * @param $columns
     * @param $min_width
     * @param $max_width
     */
    public function setContainer($columns, $min_width, $max_width)
    {
        if ($columns) {
            //die(var_dump($columns));
            $this->data['attributeList']['style'] =
                "grid-template-columns: repeat(".$columns.
                ", minmax(".$min_width.", ".$max_width."));";
        }

        $this->data['classList'][] =
            $this->getBaseClass() . '__container';
    }

    /**
     * @param $col_gap
     * @param $row_gap
     */
    public function setGaps($col_gap, $row_gap)
    {
        $this->data['classList'][] =
            $this->getBaseClass() . '__container__gap__col--' . $col_gap;

        $this->data['classList'][] =
            $this->getBaseClass() . '__container__gap__row--' . $row_gap;
        return;
    }

    /**
     * @param $col
     */
    public function setCols($col)
    {
        foreach ($col as $bp => $value) {
            $this->data['classList'][] =
                $this->getBaseClass() . '__column__start--' . strval($value[0]) . '@' . $bp;

            $this->data['classList'][] =
                $this->getBaseClass() . '__column__end--' . strval($value[1]) . "@" . $bp;
        }
        
    }

    /**
     * @param $row
     */
    public function setRows($row)
    {
        $aliases = [
            'start' => 0,
            'end' => 1
        ];

        foreach ($row as $bp => $line) {
            foreach ($aliases as $name => $key) {
                if ($line[$key] > 13) {
                    $this->data['attributeList']['style'] = 'grid-row-'. $name .': '. strval($line[$key]) .';';
                    return;
                }
            }

            $this->data['classList'][] =
                $this->getBaseClass() . '__row__start--' . strval($line[0]) . '@' . $bp;

            $this->data['classList'][] =
                $this->getBaseClass() . '__row__end--' . strval($line[1]) . "@" . $bp;
        }
    }
}