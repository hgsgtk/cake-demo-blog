<?php
use Migrations\AbstractMigration;

class CreateTableInquiries extends AbstractMigration
{
    /**
     * up
     *
     * @return void
     */
    public function up()
    {
        $this->table('inquiries')
            ->addColumn('title', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('body', 'text', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('email', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ])
            ->addColumn('client_ip', 'string', [
                'default' => null,
                'limit' => 50,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addIndex(['email'])
            ->create();
    }

    /**
     * down
     *
     * @return void
     */
    public function down()
    {
        $this->table('inquiries')->drop()->save();
    }
}
