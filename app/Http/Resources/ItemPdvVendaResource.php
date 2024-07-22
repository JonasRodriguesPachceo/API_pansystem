<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\GradeProduto;

class ItemPdvVendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $produto        = $this->produto;        
        $titulo         = "";
        $barra_grade    = "";
        if($produto->usa_grade=="S"){
            $grade       = GradeProduto::find($this->grade_produto_id);
            $titulo      = " - ". $grade->descricao;
            $barra_grade = $grade->codigo_barra;
        }
        
        $prod               = new \stdClass();
        $prod->id           = $produto->id;
        $prod->nome         = $produto->nome . $titulo;
        $prod->codigo_barra = $barra_grade;
        $prod->barra_grade  = $produto->codigo_barra;
        $prod->sku          = $produto->sku;
        $prod->imagem       = $produto->imagem;
        $prod->uuid         = $produto->uuid;
        $prod->usa_grade    = $produto->usa_grade;
        $prod->valor_venda  = $produto->valor_venda;
        
        return [           
            "id"                    => $this->id,
            "produto"               => $prod,
            "venda_id"              => $this->venda_id ,  
            "qtde"                  => $this->qtde ,  
            "valor"                 => $this->valor,
            "subtotal"              => $this->subtotal,
            "desconto_item"         => $this->desconto_item,
            "subtotal_liquido"      => $this->subtotal_liquido,
            "desconto_percentual"   => $this->desconto_percentual,
            "desconto_por_valor"    => $this->desconto_por_valor,
            "desconto_por_unidade"  => $this->desconto_por_unidade,
            "total_desconto_item"   => $this->total_desconto_item
        ];
    }
    
   
}