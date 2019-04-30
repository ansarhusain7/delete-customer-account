<?php
/**
 * Ansar Husain
 * Customer_RemoveAccount
 */

namespace Customer\RemoveAccount\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\SessionFactory;
use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;

/**
 * Class Remove
 * @package Customer\RemoveAccount\Controller\Index
 */
class Remove extends Action
{
    /**
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * @var SessionFactory
     */
    protected $_sessionFactory;

    /**
     * @var ManagerInterface
     */
    protected $_messageManager;

    /**
     * @var CustomerFactory
     */
    protected $_customerFactory;

    protected $_registry;

    /**
     * Remove constructor.
     * @param Context $context
     * @param SessionFactory $sessionFactory
     * @param PageFactory $pageFactory
     * @param ManagerInterface $messageManager
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
        Context $context ,
        SessionFactory $sessionFactory ,
        PageFactory $pageFactory ,
        ManagerInterface $messageManager,
        CustomerFactory $customerFactory,
        Registry $registry
    )
    {
        $this->_sessionFactory = $sessionFactory;
        $this->_pageFactory = $pageFactory;
        $this->_messageManager = $messageManager;
        $this->_customerFactory = $customerFactory;
        $this->_registry =$registry;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     * @throws \Exception
     */
    public function execute()
    {
        $customer = $this->_sessionFactory->create();

        if ($customer->isLoggedIn()) {
            $this->_registry->register('isSecureArea', true);
            $customerData = $this->_customerFactory->create()->load($customer->getId());
            $customerData->delete();
        }
        $this->_messageManager->addSuccess(__('Customer has been deleted'));
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/account/login');
        return $resultRedirect;

    }
}