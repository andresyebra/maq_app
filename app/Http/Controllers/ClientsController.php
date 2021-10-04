<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ClientsController extends Controller
{
       public function __construct()
        {
            $this->middleware(['auth']);
        }

        /**
         * Show the application dashboard.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('clients.index', [
                'clients' => Client::getClients()
            ]);
        }

        public function create()
        {
            $id = Input::get('empresas_id');
            $data = [
                'Clave' => Input::get('clave_cliente'),
                'Nombre' => Input::get('nombre_cliente'),
                'Telefono' => Input::get('telefono_cliente'),
                'Direccion' => Input::get('direccion_cliente'),
                'Correo' => Input::get('correo_cliente'),
                'Archivo' => Input::get('archivo_cliente'),
            ];
            $messages = [
                'required' => 'El campo :attribute es requerido.',
                'max' => 'El campo :attribute maximo :max caracteres.',
                'integer' => 'El campo :attribute debe ser entero.',
            ];

            if (Input::get('insert')) {

                $validator = Validator::make($data,
                    [
                        'Clave' => 'required|string|max:100',
                        'Nombre' => 'required|string|max:100',
                        'Telefono' => 'required|string|max:100',
                        'Direccion' => 'required|string|max:100',
                        'Correo' => 'required|string|max:100',
                        'Archivo' => 'required|string|max:100'
                    ],
                    $messages
                );

                if ($validator->fails()) {
                    return redirect('clients/index')
                        ->withErrors($validator)
                        ->withInput();
                }

                if (!empty($id)) {
                    Client::updateClient($id, $data);
                    return redirect('clients/index')->with('status', 'Cliente Actualisado Exitosamente!');
                } else {
                    Client::createClient($data);
                    return redirect('clients/index')->with('status', 'Cliente Creado Exitosamente!');
                }

            }

            return view('clients.index');
        }

        public function delete()
        {
            $data = [
                'id' => (int)Input::get('delete_client'),
            ];
            $result = Client::deleteClient($data);

            return redirect('clients/index')->with('status', 'Cliente Eliminado!');
        }

        public function getClientById($id)
        {
            $client_id = Client::getClientById($id);
            if ($client_id == null) {
                return view('errors.404');
            }

            $response = [
                'client' => $client_id
            ];
            return response()->json($response);
        }


}
