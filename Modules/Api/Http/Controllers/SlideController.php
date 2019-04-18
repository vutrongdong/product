<?php
/**
 * Created by PhpStorm.
 * User: longta
 * Date: 2019/03/04
 * Time: 11:03
 */

namespace Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\Domain\SlideService;
use App\Entities\Slide;

class SlideController extends AuthApiBaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $slideService, $model;

    public function __construct(SlideService $slideService, Slide $slide)
    {
        parent::__construct();

        $this->slideService = $slideService;

        $this->model = $slide;
    }

    public function index()
    {
        $data = $this->slideService->getAllSlides();
        return $this->returnSuccess($data);
    }

    public function create(Request $request)
    {
        $data = $this->slideService->create($request);
        return $this->returnSuccess($data);
    }

    public function uploadImage(Request $request) {
        try {
            $this->validate($request, [
                'files.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            ], [
                'files.*.image' => 'File upload không đúng định dạng',
                'files.*.mimes' => 'File upload phải là 1 trong các định dạng: :values',
                'files.*.max' => 'File upload không thể vượt quá :max KB',
                'file.image' => 'File upload không đúng định dạng',
                'file.mimes' => 'File upload phải là 1 trong các định dạng: :values',
                'file.max' => 'File upload không thể vượt quá :max KB',
            ]);
            if ($request->file('file')) {
                $image = $request->file('file');
            } else {
                $image = $request->file('files')[0];
            }
            if ($request->input('resize')) {
                return $this->model->upload($image);
            }
            return $this->model->upload($image, false);
        } catch (\Illuminate\Validation\ValidationException $validationException) {
            return response(['data' => [
                'errors' => $validationException->validator->errors(),
                'exception' => $validationException->getMessage(),
            ]])->json($data, 422);
        }
    }
}