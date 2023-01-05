<?php

namespace App\Traits;

trait Search
{
    /**
     *
     * @param string $term
     * @return string
     */
    protected function fullTextWildcards($term)
    {
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
        $words = explode(' ', $term);
        foreach ($words as $key => $word) {
            if (strlen($word) >= 3) {
                $words[$key] = $word;
            }
        }
        return implode(' ', $words);
    }

    /**
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $term
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'LIKE',$this->fullTextWildcards($term))
        ->orWhere('body', 'LIKE', $this->fullTextWildcards($term));
    }
}
