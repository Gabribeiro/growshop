<?php

namespace App\Providers;

use App\Models\Size;
use App\Models\Type;
use App\Models\Color;
use App\Models\Event;
use App\Models\Ink;
use App\Models\Shape;
use App\Models\Material;
use App\Models\Postcode;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Paginator::useBootstrapFive();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->greeting('Bem-vindo à Potiguara Grow!')
                ->subject('Potiguara Grow - Verificação de Email')
                ->line("Obrigado por se cadastrar na Potiguara Grow")
                ->line('Você pode clicar no botão abaixo para verificar seu endereço de email')
                ->action('Verificar Endereço de Email', $url);
        });


        // Verificar se as tabelas existem antes de tentar carregar os dados
        if (Schema::hasTable('types')) {
            $allTypes = Type::all();
            View::share('types', $allTypes);
        }

        if (Schema::hasTable('events')) {
            $everydayEvent = Event::all();
            $everyday = Event::where('event_group', 'Everyday Occasions')->get();
            $upcoming = Event::where('event_group', 'Upcoming Occasions')->get();
            $popularEvents = Event::where(
                'name',
                'Wedding'
            )->orWhere(
                'name',
                'Romance'
            )->orWhere(
                'name',
                'Anniversary'
            )->orWhere(
                'name', 
                'Congratulation')->get();
                
            View::share([
                'everydayEvents' => $everydayEvent,
                'popularEvents' => $popularEvents,
                'everyday' => $everyday,
                'upcoming' => $upcoming,
            ]);
        }

        if (Schema::hasTable('shapes')) {
            $allShape = Shape::all();
            View::share('shapes', $allShape);
        }

        if (Schema::hasTable('sizes')) {
            $allSize = Size::all();
            View::share('sizes', $allSize);
        }

        if (Schema::hasTable('materials')) {
            $allMaterial = Material::all();
            View::share('materials', $allMaterial);
        }

        if (Schema::hasTable('colors')) {
            $allColors = Color::all();
            View::share('colors', $allColors);
        }

        if (Schema::hasTable('postcodes')) {
            $allStates = Postcode::groupBy('state')->pluck('state');
            View::share('allStates', $allStates);
        }

        if (Schema::hasTable('inks')) {
            $allInks = Ink::all();
            View::share('inks', $allInks);
        }
    }
}
