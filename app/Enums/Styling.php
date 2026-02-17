<?php

declare(strict_types=1);

namespace App\Enums;

enum Styling
{
    // ALIASES
    case PRIMARY;
    case SECONDARY;
    case SUCCESS;
    case DANGER;
    case WARNING;
    case INFO;

    // FULL PALETTE
    case WHITE;
    case BLACK;
    case RED;
    case OUTLINE_RED;
    case ORANGE;
    case OUTLINE_ORANGE;
    case AMBER;
    case OUTLINE_AMBER;
    case YELLOW;
    case OUTLINE_YELLOW;
    case LIME;
    case OUTLINE_LIME;
    case GREEN;
    case OUTLINE_GREEN;
    case EMERALD;
    case OUTLINE_EMERALD;
    case TEAL;
    case OUTLINE_TEAL;
    case CYAN;
    case OUTLINE_CYAN;
    case SKY;
    case OUTLINE_SKY;
    case BLUE;
    case OUTLINE_BLUE;
    case INDIGO;
    case OUTLINE_INDIGO;
    case VIOLET;
    case OUTLINE_VIOLET;
    case PURPLE;
    case OUTLINE_PURPLE;
    case FUCHSIA;
    case OUTLINE_FUCHSIA;
    case PINK;
    case OUTLINE_PINK;
    case ROSE;
    case OUTLINE_ROSE;

    // GRAYSCALE PALETTE
    case SLATE;
    case OUTLINE_SLATE;
    case GRAY;
    case OUTLINE_GRAY;
    case ZINC;
    case OUTLINE_ZINC;
    case NEUTRAL;
    case OUTLINE_NEUTRAL;
    case STONE;
    case OUTLINE_STONE;

    public function getColorClasses(): array
    {
        return match ($this) {
                // ALIASES & MAIN COLORS
            self::PRIMARY, self::BLUE => [
                'solid' => 'bg-blue-600 text-white border-transparent hover:bg-blue-700 focus:ring-blue-500',
                'outline' => 'bg-transparent text-blue-600 border-blue-600 hover:bg-blue-50 focus:ring-blue-500',
                'icon' => 'text-blue-600',
            ],
            self::SECONDARY, self::WHITE => [
                'solid' => 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 focus:ring-indigo-500',
                'outline' => 'bg-transparent text-gray-700 border-gray-300 hover:bg-gray-50 focus:ring-indigo-500',
                'icon' => 'text-white',
            ],
            self::SUCCESS, self::GREEN => [
                'solid' => 'bg-green-600 text-white border-transparent hover:bg-green-700 focus:ring-green-500',
                'outline' => 'bg-transparent text-green-600 border-green-600 hover:bg-green-50 focus:ring-green-500',
                'icon' => 'text-green-600',
            ],
            self::DANGER, self::RED => [
                'solid' => 'bg-red-600 text-white border-transparent hover:bg-red-700 focus:ring-red-500',
                'outline' => 'bg-transparent text-red-600 border-red-600 hover:bg-red-50 focus:ring-red-500',
                'icon' => 'text-red-600',
            ],
            self::WARNING, self::AMBER => [
                'solid' => 'bg-amber-500 text-white border-transparent hover:bg-amber-600 focus:ring-amber-500',
                'outline' => 'bg-transparent text-amber-600 border-amber-600 hover:bg-amber-50 focus:ring-amber-500',
                'icon' => 'text-amber-500',
            ],
            self::INFO, self::SKY => [
                'solid' => 'bg-sky-600 text-white border-transparent hover:bg-sky-700 focus:ring-sky-500',
                'outline' => 'bg-transparent text-sky-600 border-sky-600 hover:bg-sky-50 focus:ring-sky-500',
                'icon' => 'text-sky-600',
            ],
            self::BLACK => [
                'solid' => 'bg-neutral-900 text-white border-transparent hover:bg-neutral-950 focus:ring-neutral-500',
                'outline' => 'bg-transparent text-black border-black hover:bg-gray-100 focus:ring-gray-800',
                'icon' => 'text-black',
            ],
            self::ORANGE => [
                'solid' => 'bg-orange-600 text-white border-transparent hover:bg-orange-700 focus:ring-orange-500',
                'outline' => 'bg-transparent text-orange-600 border-orange-600 hover:bg-orange-50 focus:ring-orange-500',
                'icon' => 'text-orange-600',
            ],
            self::YELLOW => [
                'solid' => 'bg-yellow-500 text-white border-transparent hover:bg-yellow-600 focus:ring-yellow-500',
                'outline' => 'bg-transparent text-yellow-600 border-yellow-600 hover:bg-yellow-50 focus:ring-yellow-500',
                'icon' => 'text-yellow-600',
            ],
            self::LIME => [
                'solid' => 'bg-lime-600 text-white border-transparent hover:bg-lime-700 focus:ring-lime-500',
                'outline' => 'bg-transparent text-lime-600 border-lime-600 hover:bg-lime-50 focus:ring-lime-500',
                'icon' => 'text-lime-600',
            ],
            self::EMERALD => [
                'solid' => 'bg-emerald-600 text-white border-transparent hover:bg-emerald-700 focus:ring-emerald-500',
                'outline' => 'bg-transparent text-emerald-600 border-emerald-600 hover:bg-emerald-50 focus:ring-emerald-500',
                'icon' => 'text-emerald-600',
            ],
            self::TEAL => [
                'solid' => 'bg-teal-600 text-white border-transparent hover:bg-teal-700 focus:ring-teal-500',
                'outline' => 'bg-transparent text-teal-600 border-teal-600 hover:bg-teal-50 focus:ring-teal-500',
                'icon' => 'text-teal-600',
            ],
            self::CYAN => [
                'solid' => 'bg-cyan-600 text-white border-transparent hover:bg-cyan-700 focus:ring-cyan-500',
                'outline' => 'bg-transparent text-cyan-600 border-cyan-600 hover:bg-cyan-50 focus:ring-cyan-500',
                'icon' => 'text-cyan-600',
            ],
            self::INDIGO => [
                'solid' => 'bg-indigo-600 text-white border-transparent hover:bg-indigo-700 focus:ring-indigo-500',
                'outline' => 'bg-transparent text-indigo-600 border-indigo-600 hover:bg-indigo-50 focus:ring-indigo-500',
                'icon' => 'text-indigo-600',
            ],
            self::VIOLET => [
                'solid' => 'bg-violet-600 text-white border-transparent hover:bg-violet-700 focus:ring-violet-500',
                'outline' => 'bg-transparent text-violet-600 border-violet-600 hover:bg-violet-50 focus:ring-violet-500',
                'icon' => 'text-violet-600',
            ],
            self::PURPLE => [
                'solid' => 'bg-purple-600 text-white border-transparent hover:bg-purple-700 focus:ring-purple-500',
                'outline' => 'bg-transparent text-purple-600 border-purple-600 hover:bg-purple-50 focus:ring-purple-500',
                'icon' => 'text-purple-600',
            ],
            self::FUCHSIA => [
                'solid' => 'bg-fuchsia-600 text-white border-transparent hover:bg-fuchsia-700 focus:ring-fuchsia-500',
                'outline' => 'bg-transparent text-fuchsia-600 border-fuchsia-600 hover:bg-fuchsia-50 focus:ring-fuchsia-500',
                'icon' => 'text-fuchsia-600',
            ],
            self::PINK => [
                'solid' => 'bg-pink-600 text-white border-transparent hover:bg-pink-700 focus:ring-pink-500',
                'outline' => 'bg-transparent text-pink-600 border-pink-600 hover:bg-pink-50 focus:ring-pink-500',
                'icon' => 'text-pink-600',
            ],
            self::ROSE => [
                'solid' => 'bg-rose-600 text-white border-transparent hover:bg-rose-700 focus:ring-rose-500',
                'outline' => 'bg-transparent text-rose-600 border-rose-600 hover:bg-rose-50 focus:ring-rose-500',
                'icon' => 'text-rose-600',
            ],

                // GRAYSCALE PALETTE
            self::SLATE => [
                'solid' => 'bg-slate-800 text-white border-transparent hover:bg-slate-900 focus:ring-slate-500',
                'outline' => 'bg-transparent text-slate-700 border-slate-400 hover:bg-slate-100 focus:ring-slate-500',
                'icon' => 'text-slate-600',
            ],
            self::GRAY => [
                'solid' => 'bg-gray-800 text-white border-transparent hover:bg-gray-900 focus:ring-gray-500',
                'outline' => 'bg-transparent text-gray-700 border-gray-400 hover:bg-gray-100 focus:ring-gray-500',
                'icon' => 'text-gray-600',
            ],
            self::ZINC => [
                'solid' => 'bg-zinc-800 text-white border-transparent hover:bg-zinc-900 focus:ring-zinc-500',
                'outline' => 'bg-transparent text-zinc-700 border-zinc-400 hover:bg-zinc-100 focus:ring-zinc-500',
                'icon' => 'text-zinc-600',
            ],
            self::NEUTRAL => [
                'solid' => 'bg-neutral-800 text-white border-transparent hover:bg-neutral-900 focus:ring-neutral-500',
                'outline' => 'bg-transparent text-neutral-700 border-neutral-400 hover:bg-neutral-100 focus:ring-neutral-500',
                'icon' => 'text-neutral-600',
            ],
            self::STONE => [
                'solid' => 'bg-stone-800 text-white border-transparent hover:bg-stone-900 focus:ring-stone-500',
                'outline' => 'bg-transparent text-stone-700 border-stone-400 hover:bg-stone-100 focus:ring-stone-500',
                'icon' => 'text-stone-600',
            ],
        };
    }

    public static function icon(string $variant): string
    {
        // For icons, solid and outline variants resolve to the same color.
        $colorName = str_replace('outline-', '', $variant);

        $enumCase = self::fromName($colorName);

        // We return ONLY the icon's color class.
        return $enumCase->getColorClasses()['icon'];
    }

    public static function badge(string $variant): string
    {
        $base = 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium';

        $isOutline = str_starts_with($variant, 'outline-');
        $colorName = $isOutline ? str_replace('outline-', '', $variant) : $variant;

        // Find the correct enum case from the string name
        $enumCase = self::fromName($colorName);
        $colorClasses = $enumCase->getColorClasses();

        return $base . ' ' . ($isOutline ? $colorClasses['outline'] . ' border' : $colorClasses['solid']);
    }

    public static function fromName(string $name): self
    {
        $normalizedName = str_replace('-', '_', $name);

        foreach (self::cases() as $case) {
            if (strtolower($case->name) === $normalizedName) {
                return $case;
            }
        }

        return self::PRIMARY; // Fallback
    }
}
