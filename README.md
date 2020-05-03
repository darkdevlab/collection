PHP COLLECTION
==============
This component provides emulation of collection type for work with php

### INSTALLATION:
```bash
composer require darkdevlab/collection
```

USAGE
=====
#### Collection
```php
use DarkDevLab\Collection\Collection;

class User
{
    private $name;
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function getName()
    {
        return $this->name;
    }
}

/**
 * @property User[] $container
 * @method User current()
 */
class UserCollection extends Collection
{
    public function add($user)
    {
        if (!($user instanceof User)) {
            throw new \InvalidArgumentException('unsupported type of collection item');
        }

        parent::add($user);

        return $this;
    }
}

$collection = new UserCollection();

$collection->add(new User('John'));
$collection->add(new User('John')); // Only one added. Duplication will be skipped
$collection->add(new User('Mark'));

foreach ($collection as $user) {
    echo sprintf('Username: %s', $user->getName()), PHP_EOL;
}
```
Output:
```
Username: John
Username: Mark
```
---
#### GeneratorCollection
Lazy load collection
```php
use DarkDevLab\Collection\GeneratorCollection;

class UserCollection extends GeneratorCollection
{
    
}

class UserRepository
{
    private $pdo;

    public function findAllByName(string $name): UserCollection
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `user` WHERE name=:name');
        $generator = function () use ($stmt) {
            if ($stmt->execute()) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
                    if (!empty($row)) {
                        yield new User($row['name']);
                    }
                }
            } else {
                yield;
            }
        };

        return new UserCollection($generator());
    }
}

$userRepository =  new UserRepository(/* PDO */);
$userCollection = $userRepository->findAllByName('John');

foreach ($userCollection as $user) {
    echo sprintf('Username: %s', $user->getName()), PHP_EOL;
}
```
Output:
```
Username: John
```
