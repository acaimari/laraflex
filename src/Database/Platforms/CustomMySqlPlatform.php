<?php

namespace Caimari\LaraFlex\Database\Platforms;

use Doctrine\DBAL\Platforms\MySQL57Platform;

class CustomMySqlPlatform extends MySQL57Platform
{
    /**
     * {@inheritDoc}
     */
    public function getUnknownTypeDeclarationSQL(array $field)
    {
        if ($field['type'] === 'enum') {
            return 'ENUM(' . $this->getListDeclarationSQL($field['value']) . ')';
        }

        return parent::getUnknownTypeDeclarationSQL($field);
    }
}
