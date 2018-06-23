<?php

namespace Modules\Kantoku\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Sidebar\AbstractAdminSidebar;

class RegisterKantokuSidebar extends AbstractAdminSidebar
{
    /**
     * Method used to define your sidebar menu groups and items
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('kantoku::kantoku.title'), function (Group $group) {
            $group->weight(100);
            $group->authorize(
                $this->auth->hasAccess('kantoku.sidebar.group')
            );
            $group->item(trans('kantoku::kantoku.modules'), function (Item $item) {
                $item->icon('fa fa-cogs');
                $item->weight(30);
                $item->route('admin.kantoku.modules.index');
                $item->authorize(
                    $this->auth->hasAccess('kantoku.modules.index')
                );
            });
            $group->item(trans('kantoku::kantoku.themes'), function (Item $item) {
                $item->icon('fa fa-cogs');
                $item->weight(40);
                $item->route('admin.kantoku.themes.index');
                $item->authorize(
                    $this->auth->hasAccess('kantoku.themes.index')
                );
            });
        });

        return $menu;
    }
}
