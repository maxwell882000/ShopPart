<?php

namespace App\Domain\Core\Slug\Traits;

use App\Domain\Core\Slug\Exceptions\SourceNullException;

use Illuminate\Support\Str;

trait Sluggable
{
    public static function bootSluggable()
    {

        static::creating(function ($entity) {
            try {
                $entity->setLang(config("app.fallback_locale"));
            } catch (\Exception $e) {}

            $entity->setSlug($entity);

            try {
                $entity->setLang(null);
            } catch (\Exception $e) {}

        });

    }


    public function setSlug($entity)
    {
        foreach ($entity->slugSources() as $key => $value) {
            if ($slug = $entity->getAttribute($key)) {
                $entity->setAttribute($key, $slug);
                continue;
            }

            $slug = Str::slug(Str::ascii($entity->getAttribute($value)));

            $index = 1;

            throw_unless(isset($slug), new SourceNullException());

            while ($entity->where($key, '=', $slug)->exists()) {
                $slug = $entity->getAttribute($value) . "-$index";
                $index++;
            }

            $entity->setAttribute($key, $slug);
        }
    }

    abstract public function slugSources(): array;
}
