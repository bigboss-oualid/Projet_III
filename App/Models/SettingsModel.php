<?php

namespace App\Models;

use System\Model;

class SettingsModel extends Model
{
     /**
     * Loaded Settings
     *
     * @var array
     */
    private $settings = [];

     /**
     * Load all settings in the database
     *
     * @return void
     */
    public function loadAll(): void
    {
        foreach ($this->all() as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }
    }

     /**
     * Get Settings By Key
     *
     * @param string $key
     * 
     * @return mixed
     */
    public function get($key)
    {
        return array_get($this->settings, $key);
    }

     /**
     * Update Settings
     *
     * @return void
     */
    public function updateSettings(): void
    {
        //Settings keys are stored in the file 'config'
        $parameter = $this->app->file->call('config.php');

         //Get pre-defined keys (settings) that will be stored in database
        $keys = array_get($parameter, 'site_settings');

        foreach ($keys as $key) {
            //Delete all keys and make 'insert' instead of 'update' to allow other settings to be added if needed 
            $this->where('`key` = ?', $key)->delete($this->table);
            $this->data('key', $key)
                 ->data('value', $this->request->post($key))
                 ->insert($this->table);
        }
    }
}