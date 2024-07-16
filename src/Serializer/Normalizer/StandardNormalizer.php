<?php

namespace App\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class StandardNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function __construct(private ObjectNormalizer $normalizer)
    {
    }

    public function normalize($exception, ?string $format = null, array $context = []): array
    {
        return [
            'content' => 'This is my custom problem normalizer.',
            'exception'=> [
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ],
        ];
    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \App\Entity\Standard;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
