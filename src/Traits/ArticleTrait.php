<?php

namespace App\Traits;

trait ArticleTrait
{
    public function getMonth(): array
    {
        return [
            1 => 'Janvier',
            2 => 'Février',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Aout',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Décembre'
        ];
    }

    public function articlesSerializer($articles): array
    {
        $articlesSerializes = [];
        foreach($articles as $article){
            $articlesSerializes[] = [
                'id' => $article->getId(),
                'name' => $article->getName(),
                'description' => $article->getDescription(),
                'comment' => $article->getComment(),
                'created_at' => $article->getCreatedAt()
            ];
        }
        return $articlesSerializes;
    } 
}