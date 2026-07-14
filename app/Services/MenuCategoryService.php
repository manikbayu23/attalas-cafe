<?php

namespace App\Services;

/**
 * Central service for Menu Category type definitions.
 *
 * To add or rename a type, only edit this file.
 * The rest of the application reads from here automatically.
 */
class MenuCategoryService
{
    /**
     * All registered category types with their display labels and badge colours.
     *
     * Structure:
     *   'key' => [
     *       'label'      => Indonesian label,
     *       'label_en'   => English label,
     *       'badge'      => Bootstrap badge class,
     *       'icon'       => Phosphor icon class shown in the group header,
     *       'group_icon' => Phosphor icon class shown in the "All …" filter pill,
     *   ]
     */
    public static function types(): array
    {
        return [
            'drink' => [
                'label'      => 'Minuman',
                'label_en'   => 'Drinks',
                'badge'      => 'bg-primary',
                'icon'       => 'ph-coffee',
                'group_icon' => 'ph-cup',
                'all_label'      => 'Semua Minuman',
                'all_label_en'   => 'All Drinks',
            ],
            'food' => [
                'label'      => 'Makanan',
                'label_en'   => 'Food',
                'badge'      => 'bg-success',
                'icon'       => 'ph-fork-knife',
                'group_icon' => 'ph-pizza',
                'all_label'      => 'Semua Makanan',
                'all_label_en'   => 'All Food',
            ],
            'others' => [
                'label'      => 'Lainnya',
                'label_en'   => 'Others',
                'badge'      => 'bg-secondary',
                'icon'       => 'ph-squares-four',
                'group_icon' => 'ph-squares-four',
                'all_label'      => 'Semua Lainnya',
                'all_label_en'   => 'All Others',
            ],
        ];
    }

    /**
     * Return a flat [key => label] array for use in select dropdowns.
     * Uses the Indonesian label by default.
     */
    public static function selectOptions(string $locale = 'id'): array
    {
        $options = [];
        foreach (static::types() as $key => $meta) {
            $options[$key] = $locale === 'en' ? $meta['label_en'] : $meta['label'];
        }

        return $options;
    }

    /**
     * Return metadata for a single type key, or null if unknown.
     */
    public static function get(string $type): ?array
    {
        return static::types()[$type] ?? null;
    }

    /**
     * Return all valid type keys (e.g. ['food', 'drink', 'others']).
     */
    public static function keys(): array
    {
        return array_keys(static::types());
    }

    /**
     * Return the Phosphor icon class for a category name (keyword matching).
     * Edit the keyword arrays here if you need new icon rules.
     */
    public static function iconForName(string $name): string
    {
        $name = strtolower($name);

        $rules = [
            'ph-coffee' => ['coffee', 'kopi', 'espresso', 'latte', 'frappe', 'cappuccino'],
            'ph-cup'    => ['tea', 'teh', 'matcha', 'chamomile'],
            'ph-pizza'  => ['food', 'makanan', 'snack', 'cemilan', 'rice', 'nasi', 'pasta'],
            'ph-cake'   => ['dessert', 'cake', 'kue', 'puding', 'pudding', 'es krim', 'icecream'],
            'ph-hamburger' => ['burger', 'sandwich', 'wrap'],
            'ph-bowl-food' => ['soup', 'soto', 'bakso', 'mie', 'noodle'],
            'ph-orange-slice' => ['juice', 'jus', 'smoothie', 'milkshake', 'float'],
            'ph-beer-bottle'  => ['beer', 'soda', 'soft drink', 'minuman', 'drink', 'beverage', 'mocktail', 'cocktail'],
        ];

        foreach ($rules as $icon => $keywords) {
            foreach ($keywords as $keyword) {
                if (str_contains($name, $keyword)) {
                    return $icon;
                }
            }
        }

        return 'ph-squares-four';
    }
}
