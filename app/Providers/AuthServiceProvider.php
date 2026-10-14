<?php

namespace App\Providers;

use App\Models\Bimbingan;
use App\Models\BimbinganRequest;
use App\Models\CatatanBimbingan;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PengajuanJudul;
use App\Models\User;
use App\Policies\BimbinganPolicy;
use App\Policies\BimbinganRequestPolicy;
use App\Policies\CatatanBimbinganPolicy;
use App\Policies\DosenPolicy;
use App\Policies\MahasiswaPolicy;
use App\Policies\PengajuanJudulPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\JadwalSidang;
use App\Policies\JadwalSidangPolicy;



class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Dosen::class => DosenPolicy::class,
        Mahasiswa::class => MahasiswaPolicy::class,
        PengajuanJudul::class => PengajuanJudulPolicy::class,
        Bimbingan::class => BimbinganPolicy::class,
        BimbinganRequest::class => BimbinganRequestPolicy::class,
        CatatanBimbingan::class => CatatanBimbinganPolicy::class,
        JadwalSidang::class => JadwalSidangPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}