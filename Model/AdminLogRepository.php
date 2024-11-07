<?php

namespace Bydn\AdminLogger\Model;

use Bydn\AdminLogger\Api\AdminLogRepositoryInterface;
use Bydn\AdminLogger\Api\Data\AdminLogInterface;
use Bydn\AdminLogger\Api\Data\AdminLogInterfaceFactory;
use Bydn\AdminLogger\Api\Data\AdminLogSearchResultsInterface;
use Bydn\AdminLogger\Api\Data\AdminLogSearchResultsInterfaceFactory;
use Bydn\AdminLogger\Model\ResourceModel\AdminLog as AdminLogResource;
use Bydn\AdminLogger\Model\ResourceModel\AdminLog\CollectionFactory as AdminLogCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface as Logger;

/**
 * Admin log repository
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class AdminLogRepository implements AdminLogRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var AdminLogResource
     */
    private $resource;

    /**
     * @var AdminLogCollectionFactory
     */
    private $collectionFactory;

    /**
     * @var AdminLogFactory
     */
    private $adminLogFactory;

    /**
     * @var AdminLogInterfaceFactory
     */
    private $adminLogInterfaceFactory;

    /**
     * @var AdminLogSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(
        AdminLogResource                      $resource,
        AdminLogFactory                       $adminLogFactory,
        AdminLogInterfaceFactory              $adminLogInterfaceFactory,
        AdminLogCollectionFactory             $collectionFactory,
        AdminLogSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface          $collectionProcessor,
        Logger                                $logger
    ) {
        $this->resource = $resource;
        $this->adminLogFactory = $adminLogFactory;
        $this->collectionFactory = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->adminLogInterfaceFactory = $adminLogInterfaceFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->logger = $logger;
    }

    /**
     * Retrieve entity.
     *
     * @param int $id
     * @return \Bydn\AdminLogger\Api\Data\AdminLogInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($id)
    {
        $entity = $this->adminLogFactory->create();
        $entity->load($id);
        if (!$entity->getId()) {
            throw new \Magento\Framework\Exception\NoSuchEntityException(__('Could not find entity with id "%1"', $id));
        }
        return $entity;
    }

    /**
     * Retrieve log entry matching the specified criteria.
     *
     * @param SearchCriteriaInterface $searchCriteria
     * @return \Bydn\AdminLogger\Api\Data\AdminLogSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Save log entry
     *
     * @param \Bydn\AdminLogger\Api\Data\AdminLogInterface $adminLog
     * @return \Bydn\AdminLogger\Api\Data\AdminLogInterface
     * @throws LocalizedException
     */
    public function save(AdminLogInterface $adminLog): AdminLogInterface
    {
        try {
            $this->resource->save($adminLog);
        } catch (LocalizedException $exception) {
            throw new CouldNotSaveException(
                __('Could not save the log entry: %1', $exception->getMessage()),
                $exception
            );
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the log entry: %1', $exception->getMessage()),
                $exception
            );
        }
        return $adminLog;
    }
}
