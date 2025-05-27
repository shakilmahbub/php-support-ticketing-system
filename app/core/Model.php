<?php

/**
 * Model class
 */
class Model
{
	
	protected function getall($table)
	{
		$fetch =  Db::connection()->query("SELECT * from ".$table);

		$data = $fetch->fetchAll(PDO::FETCH_OBJ);

		return $data;
	}

	protected function single($table,$id)
	{
		$fetch =  Db::connection()->query("SELECT * from ".$table." where id=".$id);

		$data = $fetch->fetch(PDO::FETCH_OBJ);

		return $data;
	}

	
	protected function create($table,$data)
	{
		$values = "'" . implode("','", array_values($data)) . "'";

		$keys = implode(',',array_keys($data));

		$isterteddata = Db::connection();
        $isterteddata->query("INSERT INTO $table ($keys) VALUES ($values)");

        $id = $isterteddata->lastInsertId();

        $lastdata = $this->single($table,$id);
		return $lastdata;
	}

	protected function update($table,$data,$id)
	{
		$values = array_values($data);
		$keys = array_keys($data);

		$setvalue = null;

		foreach ($values as $key => $value) {
			if ($value != null) {
				$setvalue .= $keys[$key] ."='". $value."',";
			}
		}
		$newsetvalue = substr($setvalue, 0, -1);
//		 return $newsetvalue;

        Db::connection()->query("UPDATE $table SET $newsetvalue where id=".$id);
        $isterteddata = $this->single($table,$id);

		return $isterteddata;
	}


	protected function delete($table,$id)
	{
		Db::connection()->query("DELETE from ".$table." where id=".$id);

		return true;
	}

}