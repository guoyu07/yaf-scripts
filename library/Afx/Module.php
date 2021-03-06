<?php
/**
 * AFX FRAMEWORK
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR
 * IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES
 * OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT
 * NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF
 * THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 * @copyright Copyright (c) 2012 BVISON INC.  (http://www.bvison.com)
 */
/**
 * @package Afx
 * @version $Id Module.php
 * The Module Class Impliment The Core ORM CRUD Operator
 * @author Afx team && firedtoad@gmail.com &&dietoad@gmail.com
 */
class Afx_Module extends Afx_Module_Abstract
{

    protected  static $__instance;
    /**
     * create the module object using the given table name
     * @param string $tablename
     * @return Afx_Module
     */
    public function __construct ($tablename = 'tablename')
    {
//        $adapter=$this->getAdapter();
//        $newadaptor=clone($adapter);
        
//        $this->
        $this->_tablename = $tablename;
        $this->_from = $tablename;
    }
    /**
     * @param boolean $create
     * @param string $database
     * @return Afx_Module_Abstract
     */
    public static function Instance($create=FALSE,$database=NULL)
    {
        $adapter=NULL;
        if((self::$__instance instanceof Afx_Module)&& (self::$__instance->_adapter instanceof Afx_Db_Adapter)&&$create)
        {
            
            $config=Yaf_Registry::get('config');
            $adapter=Afx_Db_Factory::DbDriver($config['mysql']['driver'],TRUE);
            $adapter->setConfig(self::$__instance->_adapter->getConfig());
            $th=new static();
            $th->setAdapter($adapter);
            if($database!=NULL)
            {
                $th->getAdapter()->selectDatabase($database);
            }
            return $th;
        }

        
        if(!self::$__instance instanceof Afx_Module)
        {
            self::$__instance=new static();
        }
        return self::$__instance;
    }
}