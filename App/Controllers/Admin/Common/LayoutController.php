<?php

namespace App\Controllers\Admin\Common;

use System\Controller;
use System\View\ViewInterface;

class LayoutController extends Controller
{
	/**
	 * Render the Layout with the given view Object
	 *
	 * @param System\View\ViewInterface|string  $view
	 *
	 * @return string
	 */
	public function render(ViewInterface $view): string
	{
		$data['header'] = $this->load->controller('Admin/Common/Header')->index();

		$data['content'] = $view;

		$data['sidebar'] = $this->load->controller('Admin/Common/Sidebar')->index();

		$data['footer'] = $this->load->controller('Admin/Common/Footer')->index();

		return $this->view->render('admin/common/layout', $data);
	}
}