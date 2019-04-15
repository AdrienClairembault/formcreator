<?php
/**
 * ---------------------------------------------------------------------
 * Formcreator is a plugin which allows creation of custom forms of
 * easy access.
 * ---------------------------------------------------------------------
 * LICENSE
 *
 * This file is part of Formcreator.
 *
 * Formcreator is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Formcreator is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Formcreator. If not, see <http://www.gnu.org/licenses/>.
 * ---------------------------------------------------------------------
 * @copyright Copyright © 2011 - 2019 Teclib'
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @link      https://github.com/pluginsGLPI/formcreator/
 * @link      https://pluginsglpi.github.io/formcreator/
 * @link      http://plugins.glpi-project.org/#/plugin/formcreator
 * ---------------------------------------------------------------------
 */

 namespace tests\units;
use GlpiPlugin\Formcreator\Tests\CommonTestCase;

class PluginFormcreatorLdapselectField extends CommonTestCase {

   public function testGetName() {
      $instance = new \PluginFormcreatorLdapselectField([]);
      $output = $instance->getName();
      $this->string($output)->isEqualTo('LDAP Select');
   }

   public function testIsAnonymousFormCompatible() {
      $instance = new \PluginFormcreatorLdapselectField([]);
      $output = $instance->isAnonymousFormCompatible();
      $this->boolean($output)->isFalse();
   }

   public function testIsPrerequisites() {
      $instance = $this->newTestedInstance([]);
      $output = $instance->isPrerequisites();
      $this->boolean($output)->isEqualTo(true);
   }

   public function testCanRequire() {
      $instance = new \PluginFormcreatorLdapselectField([
         'id' => '1',
      ]);
      $output = $instance->canRequire();
      $this->boolean($output)->isTrue();
   }
   
   public function testGetDocumentsForTarget() {
      $instance = $this->newTestedInstance([]);
      $this->array($instance->getDocumentsForTarget())->hasSize(0);
   }

   public function providerSerializeValue() {
      return [
         [
            'value'     => null,
            'expected'  => '',
         ],
         [
            'value'     => '',
            'expected'  => '',
         ],
         [
            'value'     => 'foo',
            'expected'  => 'foo',
         ],
         [
            'value'     => "test d'apostrophe",
            'expected'  => "test d'apostrophe",
         ],
      ];
   }

   /**
    * @dataProvider providerSerializeValue
    */
   public function testSerializeValue($value, $expected) {
      $instance = new \PluginFormcreatorLdapselectField(['id' => 1]);
      $instance->parseAnswerValues(['formcreator_field_1' => $value]);
      $output = $instance->serializeValue();
      $this->string($output)->isEqualTo($expected);
   }

   public function providerDeserializeValue() {
      return [
         [
            'value'     => '',
            'expected'  => '',
         ],
         [
            'value'     => "foo",
            'expected'  => 'foo',
         ],
         [
            'value'     => "test d'apostrophe",
            'expected'  => "test d'apostrophe",
         ],
      ];
   }

   /**
    * @dataProvider providerDeserializeValue
    */
   public function testDeserializeValue($value, $expected) {
      $instance = new \PluginFormcreatorLdapselectField([]);
      $instance->deserializeValue($value);
      $output = $instance->getValueForTargetText(false);
      $this->string($output)->isEqualTo($expected);
   }

   public function providergetValueForDesign() {
      return [
         [
            'value' => '',
            'expected' => '',
         ],
      ];
   }

   /**
    * @dataProvider providergetValueForDesign
    */
   public function testGetValueForDesign($value, $expected) {
      $instance = new \PluginFormcreatorLdapselectField([]);
      $instance->deserializeValue($value);
      $output = $instance->getValueForDesign();
      $this->string($output)->isEqualTo($expected);
   }

   
}
