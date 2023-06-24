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

use Laemmi\ContaoDownloadarchiveBundle\Resources\contao\classes\DownloadarchiveitemsBackend;

/**
 * Table tl_downloadarchiveitems
 */
$GLOBALS['TL_DCA']['tl_downloadarchiveitems'] =
[
    // Config
    'config' =>
    [
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_downloadarchive',
        'enableVersioning'            => true,
        'sql' =>
        [
            'keys' =>
            [
                'id' => 'primary',
                'pid' => 'index'
            ]
        ]
    ],

    // List
    'list' =>
    [
        'sorting' =>
        [
            'mode'                    => 4,
            'fields'                  => ['sorting'],
            'panelLayout'             => 'search,limit',
            'headerFields'            => ['title'],
            'child_record_callback'   => [DownloadarchiveitemsBackend::class, 'listFiles']
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
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ],
            'copy' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();"'
            ],
            'cut' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['cut'],
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();"'
            ],
            'delete' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if (!confirm(\'' . ($GLOBALS['TL_LANG']['tl_downloadarchiveitems']['deleteConfirm'] ?? null). '\')) return false; Backend.getScrollOffset();"'
            ],
            'toggle' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => [DownloadarchiveitemsBackend::class, 'toggleIcon']
            ],
            'show' =>
            [
                'label'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            ]
        ]
    ],

    // Palettes
    'palettes' =>
    [
        '__selector__'                => ['protected','addImage']
        ,'default'                     => '{title_legend},title,description;{file_legend:hide},singleSRC;{image_legend:hide},addImage;{protection_legend:hide},guests,protected;{publish_legend},published,start,stop'
    ],

    // Subpalettes
    'subpalettes' =>
    [
        'protected'                   => 'groups',
        'addImage'                    => 'imgSRC,alt,size,imagemargin,caption,floating,useImage'
    ],

    // Fields
    'fields' =>
    [
        'id' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ],
        'pid' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'sorting' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'tstamp' =>
        [
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ],
        'title' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'maxlength' => 255],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'description' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['description'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'eval'                    => ['rte' => 'tinyMCE'],
            'sql'                     => "text NULL"
        ],
        'singleSRC' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['singleSRC'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => ['mandatory' => true,'files' => true,'fieldType' => 'radio'],
            'sql'                     => "binary(16) NULL"
        ],
        'protected' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['protected'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['submitOnChange' => true],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'guests' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['guests'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'groups' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['groups'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'foreignKey'              => 'tl_member_group.name',
            'eval'                    => ['multiple' => true],
            'sql'                     => "blob NULL"
        ],
        'addImage' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['addImage'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['submitOnChange' => true],
            'sql'                     => "char(1) NOT NULL default ''"
        ],
        'imgSRC' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['singleSRC'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => ['mandatory' => true,'files' => true,'fieldType' => 'radio'],
            'sql'                     => "binary(16) NULL"
        ],
        'size' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['size'],
            'exclude'                 => true,
            'inputType'               => 'imageSize',
            'options'                 => $GLOBALS['TL_CROP'],
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => ['multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'alt' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['alt'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'rgxp' => 'extnd', 'maxlength' => 255, 'tl_class' => 'long'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'caption' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['caption'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'extnd', 'maxlength' => 255, 'tl_class' => 'long'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'floating' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['floating'],
            'exclude'                 => true,
            'inputType'               => 'radioTable',
            'options'                 => ['above', 'left', 'right'],
            'eval'                    => ['cols' => 3, 'tl_class' => 'w50'],
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'sql'                     => "varchar(32) NOT NULL default ''"
        ],
        'imagemargin' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_content']['imagemargin'],
            'exclude'                 => true,
            'inputType'               => 'trbl',
            'options'                 => ['px', '%', 'em', 'pt', 'pc', 'in', 'cm', 'mm'],
            'eval'                    => ['includeBlankOption' => true, 'tl_class' => 'w50'],
            'sql'                     => "varchar(255) NOT NULL default ''"
        ],
        'useImage' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['useImage'],
            'exclude'                 => true,
            'default'                 => '0',
            'inputType'               => 'radio',
            'options'                 => ['0','1','2'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['useImageReference'],
            'eval'                    => ['tl_class' => 'w50'],
            'sql'                     => "char(1) NOT NULL default '0'"
        ],
        'published' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['published'],
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'sql'                     => "char(1) NOT NULL default '0'"
        ],
        'start' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['start'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ],
        'stop' =>
        [
            'label'                   => &$GLOBALS['TL_LANG']['tl_downloadarchiveitems']['stop'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'datim', 'datepicker' => true, 'tl_class' => 'w50 wizard'],
            'sql'                     => "varchar(10) NOT NULL default ''"
        ]
    ]
];
