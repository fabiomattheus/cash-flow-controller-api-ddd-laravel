<?php

namespace Domain\Services\TEntity;

use Application\Services\Contracts\TEntity\StoreFilesInterface;
use Application\Services\Contracts\TEntity\StoreImagesInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class StoreFiles implements StoreFilesInterface
{
    /**
     * Image resize
     */
    public function execute(): array
    {

        $request = App::make(Request::class);

        if ($request->has('attachments')) {
            $paths = collect();
            foreach ($request->attachments as $file) {
                if ($file->getClientOriginalExtension() == 'jpeg'|| $file->getClientOriginalExtension() == 'png') {
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    for ($i = 0; $i < 2; $i++) {
                        if ($i == 0) {
                            $path = 'images/' . $request->model . '/thumbs/' . $request->url;
                            $image = Image::make($file)
                                ->resize(200, 200)
                                ->encode('jpg', 80);
                            Storage::disk('public')->put($path . '/' . $fileName, $image);
                            $paths->push(
                                $path . '/' . $fileName
                            );
                        } else {
                            $path = 'images/' . $request->model . '/images/' . $request->url;
                            $image = Image::make($file)
                                ->resize(200, 200)
                                ->encode('jpg', 80);
                            Storage::disk('public')->put($path . '/' . $fileName, $image);
                            $paths->push(
                                $path . '/' . $fileName
                            );
                        }
                    }
                } elseif ($file->getClientOriginalExtension() == 'pdf') {
                    $path = 'docs/' . $request->entity . $request->url;
                    $fileName = time() . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->put($path . '/' . $fileName, $file);
                    $paths->push(
                        $path . '/' . $fileName
                    );
                }else{
                    abort(Response::HTTP_BAD_REQUEST, trans('messages.error_file_deny'));

                }
            }
            return $paths->toArray();
        }
        return [];
    }
}
