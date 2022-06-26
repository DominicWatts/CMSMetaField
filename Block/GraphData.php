<?php
/**
 * Copyright © 2022 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace PixieMedia\CMSOpenGraph\Block;

use Magento\Cms\Model\Page;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class GraphData extends Template
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    protected $request;

    /**
     * @var \Magento\Cms\Model\Page
     */
    protected $_page;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Request\Http $request
     * @param \Magento\Cms\Model\Page $page
     * @param array $data
     */
    public function __construct(
        Context $context,
        Http $request,
        Page $page,
        array $data = []
    ) {
        $this->request = $request;
        $this->_page = $page;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getGraphData()
    {
        // var_dump($this->displayRoutes());
        if (!$pageId = $this->getPageId()) {
            return false;
        }

        if (!$page = $this->_page->load($pageId)) {
            return false;
        }

        return $page->getData('pixie_meta');
    }

    /**
     * Returns Page ID if provided or null
     * @return int|null
     */
    private function getPageId(): ?int
    {
        $id = $this->request->getParam('page_id') ?? $this->request->getParam('id');
        return $id ? (int)$id : null;
    }
}
