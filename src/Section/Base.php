<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Abstract section with some basic implementation.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Base implements SectionInterface
{
    use SectionData;

    /**
     * @var OptionsResolver[]
     */
    private static $resolversByClass = [];

    /**
     * @param array $properties
     */
    public function __construct(array $properties)
    {
        $this->setProperties($properties);
    }

    /**
     * {@inheritdoc}
     */
    public function setProperty($key, $value): void
    {
        $properties = $this->properties;
        $properties[$key] = $value;

        $this->setProperties($properties);
    }

    /**
     * {@inheritdoc}
     */
    public function setProperties(array $properties): void
    {
        $this->properties = $this->resolveProperties($properties);
    }

    /**
     * Resolves properties.
     *
     * @param array $properties
     *
     * @return array
     */
    protected function resolveProperties(array $properties)
    {
        $class = get_class($this);

        if (!isset(self::$resolversByClass[$class])) {
            self::$resolversByClass[$class] = new OptionsResolver();
            $this->configureProperties(self::$resolversByClass[$class]);
        }

        return self::$resolversByClass[$class]->resolve($properties);
    }

    /**
     * @param OptionsResolver $resolver
     */
    abstract protected function configureProperties(OptionsResolver $resolver);

    /**
     * Values returned from INI parser are always string
     * As a workaround to this problem you can set various normalizers to optimize the values.
     *
     * Note: The property should be defined first
     */

    /**
     * Configures an array property for OptionsResolver.
     *
     * @param string $property
     * @param OptionsResolver $resolver
     */
    protected function configureArrayProperty($property, OptionsResolver $resolver)
    {
        $resolver
            ->setAllowedTypes($property, ['array', 'string'])
            ->setNormalizer($property, function (Options $options, $value) {
                return is_array($value) ? $value : explode(',', str_replace(' ', '', $value));
            });
    }

    /**
     * Configures an environment property for OptionsResolver.
     *
     * @param OptionsResolver $resolver
     */
    protected function configureEnvironmentProperty(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('environment')
            ->setAllowedTypes('environment', ['array', 'string'])
            ->setNormalizer('environment', function (Options $options, $value) {
                if (is_array($value)) {
                    $normalized = [];

                    foreach ($value as $key => $val) {
                        is_string($key) and $normalized[] = sprintf('%s="%s"', strtoupper($key), $val);
                    }

                    $value = implode(',', $normalized);
                }

                return $value;
            });
    }

    /**
     * Configures a byte property for OptionsResolver.
     *
     * @param string $property
     * @param OptionsResolver $resolver
     */
    protected function configureByteProperty($property, OptionsResolver $resolver)
    {
        $resolver
            ->setAllowedValues($property, function($value) {return is_byte($value);})
            ->setNormalizer($property, function (Options $options, $value) {
                return is_numeric($value) ? intval($value) : $value;
            });
    }
}
