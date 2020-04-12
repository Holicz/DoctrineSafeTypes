# Doctrine Safe Types
Library implementing [thecodingmachine/safe](https://github.com/thecodingmachine/safe) `DateTime` and `DateTimeImmutable` into Doctrine.

# Motivation
In PHP >= 7.4 when you use Doctrine's types and Safe property type you'll get into trap of error
`Typed property App\Entity\User::$birthDate must be an instance of Safe\DateTimeImmutable, DateTimeImmutable used`.

For example this entity will generate the mentioned error:

```php
// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Safe\DateTimeImmutable as SafeDateTimeImmutable;

/**
 * @ORM\Entity
 */
class User
{
    ...

    /**
     * @ORM\Column(type="date_immutable")
     */
    private SafeDateTimeImmutable $birthday;

    ...
    
    public function setBirthday(SafeDateTimeImmutable $birthday): void
    {
        $this->birthday = $birthday;    
    }
    
    public function getBirthday(): SafeDateTimeImmutable
    {
        return $this->birthday;    
    }
}
``` 

This library provides safe doctrine types. The annotation would transform from `@ORM\Column(type="date_immutable")`
into `@ORM\Column(type="safe_date_immutable")`

# Installation
```
composer require dobryprogramator/doctrine-safe-types
```

Put following configuration into `config/packages/doctrine.yaml`:
```yaml
doctrine:
    dbal:
        ...
        types:
            safe_date: DobryProgramator\DoctrineSafeTypes\Type\SafeDateType
            safe_date_immutable: DobryProgramator\DoctrineSafeTypes\Type\SafeDateImmutableType
            safe_datetime: DobryProgramator\DoctrineSafeTypes\Type\SafeDateTimeType
            safe_datetime_immutable: DobryProgramator\DoctrineSafeTypes\Type\SafeDateTimeImmutableType
            safe_datetimetz: DobryProgramator\DoctrineSafeTypes\Type\SafeDateTimeTzType
            safe_datetimetz_immutable: DobryProgramator\DoctrineSafeTypes\Type\SafeDateTimeTzImmutableType
            safe_time: DobryProgramator\DoctrineSafeTypes\Type\SafeTimeType
            safe_time_immutable: DobryProgramator\DoctrineSafeTypes\Type\SafeTimeImmutableType
```
