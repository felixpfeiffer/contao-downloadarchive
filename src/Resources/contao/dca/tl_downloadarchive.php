<?php

/**
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * @category   contao-downloadarchive
 * @author     Michael Lämmlein <laemmi@spacerabbit.de>
 * @copyright  ©2023 laemmi
 * @license    http://www.opensource.org/licenses/mit-license.php MIT-License
 * @version    1.0.0
 * @since      20.06.23
 */

declare(strict_types=1);

/**
 * Table tl_downloadarchive
 */

use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\classes\DownloadarchiveBackend;

$GLOBALS['TL_DCA']['tl_downloadarchive'] =
[
    // Config
    'config' =>
    [
        'dataContainer'               => 'Table',
        'ctable'                      => ['tl_downloadarchiveitems'],
        'enableVersioning'            => true,
        'switchToEdit'                => true,
        'onload_callback'             =>
        [
            [DownloadarchiveBackend::class, 'checkPermission']
        ],
        'onsubmit_callback'           =>
        [
            [DownloadarchiveBackend::class, 'loadDirectory']
        ],
        'sql' =>
        [
            'keys' =>
            [
                'id' => 'primary'
            ]
        ]
    ],

    // List
    'list' =>
    [
        'sorting' =>
        [
            'mode'                    => 1,
            'fields'                  => ['title'],
            'flag'                    => 1,
            'panelLayout'             => 'sort,limit'
        ],
        'label' =>
        [
            'fields'                  => ['title'],
            'format'                  => '%s'
        ],
        'global_operations' =>
        [
            'all' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset();"'
            ]
        ],
        'operations' =>
        [
            'edit' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchive']['edit'],
                'href'                => 'table=tl_downloadarchiveitems',
                'icon'                => 'edit.gif'
            ],
            'editheader' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchive']['editheader'],
                'href'                => 'act=edit',
                'icon'                => 'header.gif'
            ],
            'copy' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchive']['copy'],
                'href'                => 'act=copy',
                'icon'                => 'copy.gif',
                'button_callback'     => [DownloadarchiveBackend::class, 'copyArchive']
            ],
            'delete' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchive']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['tl_downloadarchive']['deleteConfirm'] ?? null) . '\')) return false; Backend.getScrollOffset();"',
                'button_callback'     => [DownloadarchiveBackend::class, 'deleteArchive']
            ],
            'show' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchive']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            ]
        ]
    ],

    // Palettes
    'palettes' =>
    [
        '__selector__'                => ['loadDirectory'],
        'default'                     => '{title_legend},title,class;{directory_legend:hide},loadDirectory;{publish_legend},published,start,stop'
    ],

    // Subpalettes
    'subpalettes' =>
    [
        'loadDirectory'                   => 'dirSRC,loadSubdir,extension,prefix,publishAll'
    ],

    // Fields
    'fields' =>
    [
        'id' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ],
        'tstamp' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'title' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'maxlength' => 255],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'loadDirectory' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['loadDirectory'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['submitOnChange' => true],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'loadSubdir' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['loadSubdir'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'w50'],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'dirSRC' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['dirSRC'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => ['files' => false, 'fieldType' => 'radio','tl_class' => 'w50'],
            'sql'                     => "binary(16) NULL"
        ],
        'prefix' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['prefix'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 100,'tl_class' => 'w50'],
            'sql'                     => "varchar(100) NOT NULL default ''"
        ],
        'extension' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['extension'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 255,'tl_class' => 'clr w50'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'publishAll' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['publishAll'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'clr m12'],
            'sql'                     => "char(1) NOT NULL default '0'"
        ],
        'class' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['class'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 255],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'published' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['published'],
            'default'                 => true,
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default '1'"
        ],
        'start' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ],
        'stop' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchive']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ]
    ]
];
