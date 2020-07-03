<?php

namespace api\components;

use yii\rest\Serializer;
use yii\web\Link;

class ApiSerializer extends Serializer
{
    /**
     * @inheritdoc
     */
    public $collectionEnvelope = 'items';
    /**
     * @inheritdoc
     * @var string|false
     */
    public $linksEnvelope = false;
    /**
     * @inheritdoc
     */
    public $metaEnvelope = 'pagination';

    /**
     * 验证失败的返回错误集合
     * @var string|false
     */
    public $modelErrorsEnvelope = 'errors';
    /**
     * 是否要在 headers 中显示分页信息
     * @var bool
     */
    public $addPaginationHeaders = false;
    /**
     * 总数
     * @var string
     */
    public $paginationTotalCount = 'total_count';
    /**
     * 总页数
     * @var string
     */
    public $paginationPageCount = 'page_count';
    /**
     * 当前页
     * @var string
     */
    public $paginationCurrentPage = 'current_page';
    /**
     * 每页显示数量
     * @var string
     */
    public $paginationPageSize = 'page_size';

    /**
     * 调整：让 linksEnvelope 和 metaEnvelope 可以分开显示
     * @inheritdoc
     */
    protected function serializePagination($pagination)
    {
        $result = [];
        if ($this->linksEnvelope) {
            $result[$this->linksEnvelope] = Link::serialize($pagination->getLinks(true));
        }
        if ($this->metaEnvelope) {
            $result[$this->metaEnvelope] = [
                $this->paginationTotalCount => $pagination->totalCount,
                $this->paginationPageCount => $pagination->getPageCount(),
                $this->paginationCurrentPage => $pagination->getPage() + 1,
                $this->paginationPageSize => $pagination->getPageSize(),
            ];
        }
        return $result;
    }

    /**
     * 调整：model 错误时序列话结果调整
     * @inheritdoc
     */
    protected function serializeModelErrors($model)
    {
        $data = parent::serializeModelErrors($model);
        if ($this->modelErrorsEnvelope) {
            return [$this->modelErrorsEnvelope => $data];
        }
        return $data;
    }

    /**
     * 可以关闭headers中显示分页信息
     * @inheritdoc
     */
    protected function addPaginationHeaders($pagination)
    {
        if ($this->addPaginationHeaders) {
            parent::addPaginationHeaders($pagination);
        }
    }
}
