<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inquiry $inquiry
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Inquiry'), ['action' => 'edit', $inquiry->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Inquiry'), ['action' => 'delete', $inquiry->id], ['confirm' => __('Are you sure you want to delete # {0}?', $inquiry->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Inquiries'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Inquiry'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="inquiries view large-9 medium-8 columns content">
    <h3><?= h($inquiry->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($inquiry->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($inquiry->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Client Ip') ?></th>
            <td><?= h($inquiry->client_ip) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($inquiry->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($inquiry->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($inquiry->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Body') ?></h4>
        <?= $this->Text->autoParagraph(h($inquiry->body)); ?>
    </div>
</div>
