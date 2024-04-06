<?php
// Controllers
// Os Controllers são parte fundamental de toda aplicação em Laravel;
// , Geralmente condensam a maior parte da lógica;
// Tem o papel de enviar e esperar resposta do banco de dados;
// E também receber e enviar alguma resposta para as views;
// Os Controllers podem ser criados via artisan;
// É comum retornar uma view ou redirecionar para uma URL pelo Controller;

// <!-- sempre que possivel optar por utilizar o "artisan" para gerar, pois ele ja vem padronizado -->
// <!-- rodar o comando  "php artisan make:controller EventController" -->

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event; // importa o model Event
use App\Models\User;

class EventController extends Controller
{

    public function index()
    {
        $search =  request('search');
        if ($search) {
            // Retrieve events from the database
            $events = Event::where([
                ['title', 'like', '%' . $search . '%'],
            ])->get();
        } else {
            $events = Event::all();
        }

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        // pasta events na view create.blade.php
        return view('events.create');
    }

    /*store é o metodo comumente usado para lidar com salvamento de forms*/
    public function store(Request $request)
    {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items; // simplesmente apontar para o campo do form dessa forma vai fazer ele interpretar como string, é preciso ajustar isso no model

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        $user = auth()->user();
        $event->user_id = $user->id;

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!'); //with define uma flash message da session para exibir
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        // acesso ao dono do evento criado
        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }

    public function dashboard()
    {
        $user = auth()->user();
        $events = $user->events;

        return view('events.dashboard', ['events' => $events]);
    }

    public function destroy($id)
    {
        Event::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!'); //with define uma flash message da session para exibir
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        return view('events.edit', ['event' => $event]);
        // return redirect('/dashboard')->with('msg', 'Evento deletado com sucesso!'); //with define uma flash message da session para exibir
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName; //acessa o dado image do form
        }


        Event::findOrFail($request->id)->update($data); //request->all()

        return redirect('/dashboard')->with('msg', 'Evento atualizado com sucesso!'); //with define uma flash message da session para exibir
    }

    public function joinEvent($id)
    {

        $user = auth()->user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);
    }
}
