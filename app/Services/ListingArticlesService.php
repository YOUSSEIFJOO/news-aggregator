<?php

namespace App\Services;

use App\Models\Article;

class ListingArticlesService
{
    protected $query;

    protected $data;

    public function getArticlesWithPagination($data)
    {
        $this->startQuery($data);

        return $this->searchInArticles()
            ->filterByPeriod()
            ->filterByCategories()
            ->filterBySources()
            ->filterByAuthors()
            ->getQuery()
            ->paginate($data['per_page'] ?? 20, ['*'], 'page', $data['page'] ?? 1);
    }

    public function startQuery($data): void
    {
        $this->query = Article::select(
            'title', 'description', 'content', 'source', 'category', 'author',
            'url', 'image_url', 'published_at'
        );
        $this->data = $data;
    }

    public function getQuery()
    {
        return $this->query;
    }

    private function searchInArticles(): static
    {
        if (!empty($this->data['search'])) {
            $search = '%' . trim($this->data['search']) . '%';
            $this->query->where(function ($query) use ($search) {
                $query->where('title', 'like', $search)
                    ->orWhere('description', 'like', $search)
                    ->orWhere('content', 'like', $search);
            });
        }

        return $this;
    }

    private function filterByPeriod(): static
    {
        if (!empty($this->data['filtration'])) {
            if (!empty($this->data['filtration']['from_date']) && !empty($this->data['filtration']['to_date'])) {
                $this->query->whereBetween('published_at', [$this->data['filtration']['from_date'], $this->data['filtration']['to_date']]);
            } elseif (!empty($this->data['filtration']['from_date']) && empty($this->data['filtration']['to_date'])) {
                $this->query->where('published_at', '>=', $this->data['filtration']['from_date']);
            } elseif (empty($this->data['filtration']['from_date']) && !empty($this->data['filtration']['to_date'])) {
                $this->query->where('published_at', '<=', $this->data['filtration']['to_date']);
            }
        }

        return $this;
    }

    private function filterByCategories(): static
    {
            $categories = array_filter([
                $this->data['filtration']['category'] ?? null,
                ...($this->data['user_preferences']['categories'] ?? [])
            ]);

            if (count($categories) > 0) {
                $this->query->whereIn('category', $categories);
            }

        return $this;
    }

    private function filterBySources(): static
    {
        if(!empty($this->data['filtration']) && !empty($this->data['user_preferences'])) {
            $sources = array_filter([
                $this->data['filtration']['source'] ?? null,
                ...($this->data['user_preferences']['sources'] ?? [])
            ]);

            if (count($sources) > 0) {
                $this->query->whereIn('source', $sources);
            }
        }

        return $this;
    }

    private function filterByAuthors(): static
    {
        if(!empty($this->data['user_preferences'])) {
            if (!empty($this->data['user_preferences']['authors'])) {
                $this->query->whereIn('author', $this->data['user_preferences']['authors']);
            }
        }

        return $this;
    }
}
