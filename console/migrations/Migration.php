<?php

namespace console\migrations;

class Migration extends \yii\db\Migration
{
    public $_tableOption = null;

    public function init()
    {
        parent::init();
        $this->_tableOption = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $this->_tableOption = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
    }

    /**
     * @param string $tableComment
     * @return null|string
     */
    public function setTableComment($tableComment)
    {
        if ($this->db->driverName === 'mysql') {
            return $this->_tableOption . ' COMMENT=\'' . $tableComment . '\'';
        }
        return null;
    }

    /**
     * @param array $include
     * @return array
     */
    public function commonColumns($include = [])
    {
        $arr = [
            'sort' => $this->integer()->notNull()->defaultValue(10)->comment('排序'),
            'status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('状态'),
            'created_at' => $this->integer()->notNull()->defaultValue(0)->comment('创建时间'),
            'created_by' => $this->integer()->notNull()->defaultValue(0)->comment('创建人'),
            'updated_at' => $this->integer()->notNull()->defaultValue(0)->comment('修改时间'),
            'updated_by' => $this->integer()->notNull()->defaultValue(0)->comment('修改人'),
        ];
        $returnArr = [];
        if ($include) {
            foreach ($include as $key) {
                $returnArr[$key] = isset($arr[$key]) ? $arr[$key] : '';
            }
        }
        return $returnArr;
    }

    /**
     * @param $table
     * @param $columns
     * @param bool $unique
     */
    public function createIndexCustom($table, $columns, $unique = false)
    {
        $name = 'idx-' . $table . '-' . implode('-', (array)$columns);
        parent::createIndex($name, $table, $columns, $unique);
    }

    /**
     * @param $table
     * @param $columns
     */
    public function dropIndexCustom($table, $columns)
    {
        $name = 'idx-' . $table . '-' . implode('-', (array)$columns);
        parent::dropIndex($name, $table);
    }

    /**
     * @param $table
     * @param $columns
     * @param $refTable
     * @param string $refColumns
     * @param null $delete
     * @param null $update
     */
    public function addForeignKeyCustom($table, $columns, $refTable, $refColumns = 'id', $delete = null, $update = null)
    {
        $name = 'fk-' . $table . '-' . $refTable;
        parent::addForeignKey($name, $table, $columns, $refTable, $refColumns, $delete, $update);
    }

    /**
     * @param $table
     * @param $refTable
     */
    public function dropForeignKeyCustom($table, $refTable)
    {
        $name = 'fk-' . $table . '-' . $refTable;
        parent::dropForeignKey($name, $table);
    }
}