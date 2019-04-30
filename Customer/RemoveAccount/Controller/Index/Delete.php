<?php
/**
 * Ansar Husain
 * Customer_RemoveAccount
 */

namespace Customer\RemoveAccount\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    protected $_pageFactory;


    public function __construct(Context $context , PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $page = $this->_pageFactory->create();

        $page->getConfig()->getTitle()->set('Delete Customer');

        return $page;


        // TODO: Implement execute() method.
    }
}