<?php

namespace App\Providers;

use Domain\Dto\Contracts\DtoInterface;
use Domain\Dto\Dto;
use Domain\VOs\DateVo;
use Domain\VOs\IdVo;
use Domain\VOs\TypeVo;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Domain\VOs\Contracts\IdVoInterface', function ($params) {
            $request = $this->app->make(Request::class);
            return new IdVo(Array('id'=>$request->id));
        });

        $this->app->bind('Domain\VOs\Contracts\TypeVoInterface', function ($params) {
            $request = $this->app->make(Request::class);
            return new TypeVo(Array('type'=>$request->type));
        });

        $this->app->bind('Domain\VOs\Contracts\DateVOInterface', function ($params) {
            $request = $this->app->make(Request::class);
            return new DateVo(Array('initialDate'=> $request->initialDate, 'finalDate'=> $request->finalDate ?? $request->initialDate));
        });

        $this->app->bind(DtoInterface::class, function ($params) {
            return Dto::class;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
