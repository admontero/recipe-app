<?php

namespace App\Actions\Recipe;

use App\DataTransferObjects\RecipeData;
use App\Models\Recipe;
use App\Models\Tag;
use DOMDocument;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Symfony\Component\Mime\MimeTypes;

class UpsertRecipeAction
{
    public function handle(RecipeData $data, Recipe $recipe = null): void
    {
        $recipe = Recipe::updateOrCreate(
            [
                'id' => $recipe?->id,
            ],
            [
                'title' => $data->title,
                'excerpt' => $data->excerpt,
                'ingredients' => $data->ingredients,
                'published_at' => $data->published_at,
                'category_id' => $data->category_id,
                'user_id' => auth()->id(),
            ]
        );

        $this->saveMainImage($recipe, $data->image, $data->imageExtension);

        $this->saveImagesFromData($recipe, ['description' => $data->description, 'preparation' => $data->preparation]);

        $this->saveTags($recipe, $data->tags);

        $this->deleteImagesNotContained($recipe, ['description', 'preparation']);
    }

    private function saveMainImage(Recipe $recipe, string $imageTmp = null, string $extension = null): void
    {
        if (! $imageTmp) return ;

        if ($recipe->image && Storage::disk('public')->exists($recipe->image))
            Storage::disk('public')->delete($recipe->image);

        $filename = $recipe->slug . '.' . $extension;

        $path = Storage::disk('public')->putFileAs('recipes', new File($imageTmp), $filename);

        $manager = ImageManager::gd();

        $image = $manager->read(storage_path() . '/app/public/' . $path);

        $image->cover(400, 300);

        $image->save();

        $recipe->image = $path;

        $recipe->save();
    }

    private function saveImagesFromData(Recipe $recipe, array $fields = []): void
    {
        foreach ($fields as $key => $content) {
            preg_match_all('/<img[^>]+src="data:image\/([^;]+);base64,([^">]+)"/i', $content, $matches);

            foreach ($matches[0] as $index => $match) {
                $base64Data = $matches[2][$index];

                $imageContent = base64_decode($base64Data);

                $mimeType = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $imageContent);

                $extension = MimeTypes::getDefault()->getExtensions($mimeType)[0];

                $filename = basename($base64Data);

                $path = "content/{$recipe->slug}/{$filename}.{$extension}";

                Storage::disk('public')->put($path, $imageContent);

                $content = str_replace(
                    $match,
                    '<img src="' . asset('storage/' . $path) . '"',
                    $content
                );
            }

            $recipe->{$key} = $this->formatImagesAttributes($content);
        }

        $recipe->save();
    }

    private function saveTags(Recipe $recipe, array $tags): void
    {
        $tags = collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                return Tag::find($tag)->id ?? null;
            }

            return Tag::firstOrCreate(['name' => $tag], ['name' => $tag])->id;
        });

        $recipe->tags()->sync($tags->filter()->all());
    }

    private function deleteImagesNotContained(Recipe $recipe, array $fields = []): void
    {
        $path = 'content/' . $recipe->slug;

        $files = Storage::disk('public')->allFiles($path);

        foreach ($files as $file) {
            $url = asset('storage/' . $file);

            if ($this->isImageContained($recipe, $url, $fields)) continue;

            Storage::disk('public')->delete($file);
        }
    }

    private function isImageContained(Recipe $recipe, string $url, array $fields = []): bool
    {
        foreach ($fields as $field) {
            if (str_contains($recipe->{$field}, $url)) return true;
        }

        return false;
    }

    private function formatImagesAttributes(string $content, array $attributes = ['style']): string
    {
        preg_match_all('/<img(.*?)src=("|\'|)(.*?)("|\'| )(.*?)>/s', $content, $images);

        foreach ($images[0] as $image) {
            $dom = new DOMDocument;
            $dom->loadHTML($image);

            $element = $dom->getElementsByTagName('img')->item(0);

            foreach ($attributes as $value) {
                if ($element->hasAttribute($value)) {
                    $element->removeAttribute($value);
                }
            }

            $classAttribute = $dom->createAttribute('class');

            $classAttribute->value = 'img-fluid rounded';

            $element->appendChild($classAttribute);

            $newTag = $dom->saveHTML($element);

            $content = str_replace($image, $newTag, $content);
        }

        return $content;
    }
}
