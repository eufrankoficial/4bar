@extends('layouts.email')
@section('logo', $message->embed(public_path().'/assets/core/images/logo_dark.png'))
@section('titulo', 'Recuperar senha')
@section('descricao', 'Você solicitou um novo cadastro de senha, esse link é válido por 60min.')
@section('conteudo')
    <tr>
        <td bgcolor="#FFFFFF" style="padding: 32px 16px 56px 16px;">
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" target="_blank" style="padding: 12px 20px 12px 20px; background: #ffa202; border: 0; color: #FFFFFF; font-size: 14px; font-weight: normal; border-radius: 5px;">
                Clique aqui
            </a>
        </td>
    </tr>
@endsection
