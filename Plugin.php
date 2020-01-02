<?php namespace BlackScorp\OctoberTopicVoter;

use Backend;
use System\Classes\PluginBase;

/**
 * TopicList Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Topic Voter',
            'description' => 'Plugin to manage topic lists',
            'author'      => 'Vitalij Mik',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {

        return [
            'BlackScorp\OctoberTopicVoter\Components\TopicList' => 'topicList',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'blackscorp.octobertopicvoter.some_permission' => [
                'tab' => 'TopicList',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return []; // Remove this line to activate

        return [
            'topicvoter' => [
                'label'       => 'OctoberTopicList',
                'url'         => Backend::url('blackscorp/octobertopicvoter/mycontroller'),
                'icon'        => 'icon-leaf',
                'permissions' => ['blackscorp.octobertopicvoter.*'],
                'order'       => 500,
            ],
        ];
    }
}
