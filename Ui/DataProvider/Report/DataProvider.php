<?php

namespace Bydn\AdminLogger\Ui\DataProvider\Report;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Bydn\AdminLogger\Model\ResourceModel\AdminLog\CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param \Bydn\AdminLogger\Model\ResourceModel\AdminLog\CollectionFactory $collectionFactory
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        \Bydn\AdminLogger\Model\ResourceModel\AdminLog\CollectionFactory $collectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collection = $this->collectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = [];
        foreach ($this->getCollection() as $item) {
            $items[] = $item->getData();
        }
        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => $items,
        ];

        return $data;
    }
}
