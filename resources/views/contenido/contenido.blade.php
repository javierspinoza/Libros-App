@extends('principal')
@section('contenido')    

    @if(Auth::check())
        @if (Auth::user()->id_rol == 1)

        <template v-if="menu==1">

            <autor></autor>
            
        </template>
    
        <template v-if="menu==2">
    
            <categoria></categoria>
            
        </template>
    
        <template v-if="menu==3">
    
            <editorial></editorial>
            
        </template>
    
        <template v-if="menu==4">
    
            <idioma></idioma>
            
        </template>
    
        <template v-if="menu==5">
    
            <pais></pais>
            
        </template>
    
        <template v-if="menu==6">
    
            <libro></libro>
            
        </template>
    
        <template v-if="menu==7">
    
            <prestamo></prestamo>
            
        </template>
    
        <template v-if="menu==8">
    
            <persona></persona>
            
        </template>
    
        <template v-if="menu==9">
    
            <rol></rol>
            
        </template>
    
        <template v-if="menu==10">
    
            <user></user>
            
        </template>

        @elseif (Auth::user()->id_rol == 2)

        <template v-if="menu==6">
    
            <libro></libro>
            
        </template>
    
        <template v-if="menu==7">
    
            <prestamo></prestamo>
            
        </template>

        @else

        @endif

    @endif

@endsection