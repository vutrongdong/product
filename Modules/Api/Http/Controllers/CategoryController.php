<?php

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Api\Http\Requests\CategoryUpdateRequest;
use Modules\Api\Http\Requests\CategoryAddRequest;
use App\Services\Domain\CategoryService;

class CategoryController extends AuthApiBaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $CategoryService;

    public function __construct(CategoryService $categoryService)
    {
        parent::__construct();

        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $data = $this->categoryService->getAllCategory();
        return $this->returnSuccess($data);
    }

    public function show($id)
    {
        $data = $this->categoryService->show($id);
        return $this->returnSuccess($data);
    }

    public function getCategoriesForSelect($diffIdCurent)
    {
        $data = $this->categoryService->getCategoriesForSelect($diffIdCurent);
        return $this->returnSuccess($data);
    }

    public function getCategoriesForMenu()
    {
        $data = $this->categoryService->getCategoriesForMenu();
        return $this->returnSuccess($data);
    }

    public function createCategory(CategoryAddRequest $request)
    {
        $data = $this->categoryService->createCategory($request->all());
        return $this->returnSuccess($data);
    }

    public function updadeCategory(CategoryUpdateRequest $request, $id)
    {
        $data = $this->categoryService->updadeCategory($request, $id);
        return $this->returnSuccess($data);
    }

    public function removeCategory($id)
    {
        $data = $this->categoryService->removeCategory($id);
        return $this->returnSuccess($data);
    }
}