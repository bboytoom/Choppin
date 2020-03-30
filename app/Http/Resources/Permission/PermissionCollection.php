<?php

namespace App\Http\Resources\Permission;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PermissionCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => PermissionResource::collection($this->collection)
        ];
    }

    public function with($request)
    {
        return [
            'permissions' => [
                'Mostrar usuarios' => 'read-administration',
                'Detalles de usuario' => 'detail-administration',
                'Crear usuario' => 'create-administration',
                'Actualizar usuario' => 'update-administration',
                'Eliminar usuario' => 'delete-administration',
                'Mostrar categorias' => 'read-category',
                'Detalles de la categoria' => 'detail-category',
                'Crear categoria' => 'create-category',
                'Actualizar categoria' => 'update-category',
                'Eliminar categoria' => 'delete-category',
                'Mostrar caracteristicas' => 'read-characteristic',
                'Detalles de la caracteristica' => 'detail-characteristic',
                'Crear caracteristica' => 'create-characteristic',
                'Actualizar caracteristica' => 'update-characteristic',
                'Eliminar caracteristica' => 'delete-characteristic',
                'Mostrar configuraciones' => 'read-configuration',
                'Detalles de la configuracion' => 'detail-configuration',
                'Actualizar configuracion' => 'update-configuration',
                'Mostrar configuraciones' => 'read-configuration',
                'Detalles de la configuracion' => 'detail-configuration',
                'Actualizar configuracion' => 'update-configuration',
                'Eliminar configuracion' => 'delete-configuration',
                'Mostrar metadatos' => 'read-meta',
                'Detalles de los metadatos ' => 'detail-meta',
                'Actualizar metadatos' => 'update-meta',
                'Detalles del perfil' => 'detail-perfil',
                'Actualizar perfil' => 'update-perfil',
                'Mostrar permisos' => 'read-permission',
                'Detalles del permiso' => 'detail-permission',
                'Crear permiso' => 'create-permission',
                'Actualizar permiso' => 'update-permission',
                'Eliminar permiso' => 'delete-permission',
                'Mostrar productos' => 'read-product',
                'Detalles del producto' => 'detail-product',
                'Crear producto' => 'create-product',
                'Actualizar producto' => 'update-product',
                'Eliminar producto' => 'delete-product',
                'Mostrar datos de envio' => 'read-shipping',
                'Detalles de envio' => 'detail-shipping',
                'Crear datos de envio' => 'create-shipping',
                'Actualizar datos de envio' => 'update-shipping',
                'Eliminar datos de envio' => 'delete-shipping',
                'Mostrar subcategorias' => 'read-subcategory',
                'Detalles de la subcategoria' => 'detail-subcategory',
                'Crear subcategoria' => 'create-subcategory',
                'Actualizar subcategoria' => 'update-subcategory',
                'Eliminar subcategoria' => 'delete-subcategory'
            ]
        ];
    }
}
