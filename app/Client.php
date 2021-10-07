<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $timestamps = false;

    public static function getClients()
    {
        return DB::table('clients')->get();
    }

    public static function getDataByClient()
    {
        return DB::table('clients')->where('clave', '=', Auth::user()->empresa)->first();
    }

    public static function createClient($data)
    {
        return DB::table('clients')->insertGetId([
            'clave' => $data['Clave'],
            'nombre' => $data['Nombre'],
            'telefono' => $data['Telefono'],
            'direccion' => $data['Direccion'],
            'correo' => $data['Correo'],
            'archivo_clientes' => $data['Archivo']
        ]);
    }

    public static function deleteClient($id)
    {
        $delete = DB::table('clients')->where('id', '=', $id['id'])->delete();
    }

    public static function updateClient($id, $data)
    {
        $updated = DB::table('clients')->where('id', $id)
            ->update([
                'clave' => $data['Clave'],
                'nombre' => $data['Nombre'],
                'telefono' => $data['Telefono'],
                'direccion' => $data['Direccion'],
                'correo' => $data['Correo'],
                'archivo_clientes' => $data['Archivo']
            ]);

        return $updated;
    }

    public static function getClientById($id)
    {
        return DB::table('clients')->where('id', '=', $id)->first();
    }
}
