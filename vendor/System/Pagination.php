<?php

namespace System;

class Pagination
{
     /**
     * Application Object
     *
     * @var \System\Application
     */
    private $app;

     /**
     * Total Items
     *
     * @var int
     */
    private $totalItems;

     /**
     * Items Per Page
     *
     * @var int
     */
    private $itemsPerPage = 4;

     /**
     * Last Page Number = Total Pages
     *
     * @var int
     */
    private $lastPage;

     /**
     * Current Page Number
     *
     * @var int
     */
    private $page = 1;

     /**
     * Constructor
     *
     * @param \System\Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $this->setCurrentPage();
    }

     /**
     * Set Current Page
     *
     * @return void
     */
    private function setCurrentPage(): void
    {
        $page = $this->app->request->get('page');

        //verify the passed query string parameter page is a number & >= 1
        if (! is_numeric($page) OR $page < 1) {
            $page = 1;
        }

        $this->page = $page;
    }

     /**
     * Get Current Page Number
     *
     * @return int
     */
    public function page(): int
    {
        return $this->page;
    }

     /**
     * Get Items Per Page
     *
     * @return int
     */
    public function itemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

     /**
     * Get Total Items
     *
     * @return int
     */
    public function totalItems(): int
    {
        return $this->totalItems;
    }

     /**
     * Get Last Page
     *
     * @return int
     */
    public function last(): int
    {
        return $this->lastPage;
    }

     /**
     * Get Next Page number
     *
     * @return int
     */
    public function next(): int
    {
        return $this->page + 1;
    }

     /**
     * Get Previous Page number
     *
     * @return int
     */
    public function prev(): int
    {
        return $this->page - 1;
    }

     /**
     * Set Total Items
     *
     * @param int $totalItems
     * 
     * @return $this
     */
    public function setTotalItems($totalItems)
    {
        $this->totalItems = $totalItems;

        return $this;
    }

     /**
     * Set Items Per Page
     *
     * @param int $itemsPerPage
     * 
     * @return $this
     */
    public function setItemsPerPage($itemsPerPage)
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

     /**
     * Start Pagination
     *
     * @return $this
     */
    public function paginate()
    {
        $this->setLastPage();

        return $this;
    }

     /**
     * Set Last Page
     *
     * @return void
     */
    private function setLastPage(): void
    {
        $this->lastPage = ceil($this->totalItems / $this->itemsPerPage);
    }

}