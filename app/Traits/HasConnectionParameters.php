<?php

namespace App\Traits;

use App\Models\ConnectionParameter;

trait HasConnectionParameters {

	protected $cachedParameters = [];

	public function connectionParameters(){
		return $this->hasMany(ConnectionParameter::class);
	}

	public function getParametersAttribute(){
		if(empty($this->cachedParameters)){
			$this->cachedParameters = $this->connectionParameters->pluck('parameter_value', 'parameter_key');
		}
		return $this->cachedParameters;
	}

	public function scopeWhereHasParameter($q, $key){
		return $q->whereHas('connectionParameters', function($q) use($key){
			$q->where('parameter_key', '=', $key);
		});
	}

	public function hasParameter($key){
		return $this->parameters->has($key);
	}

	public function getParameter($key){
		if($this->hasParameter($key)){
			return $this->parameters->get($key);
		}
		return null;
	}

	public function setParameter($key, $value, $domain_id = 0){
		$q = $this->connectionParameters()->where('parameter_key', $key);
		if($domain_id !== 0){
			$q->where('domain_id', '=', $domain_id);
		}
		$parameter = $q->first();
		if(is_null($parameter)){
			$parameter = new ConnectionParameter();
			$parameter->connection_id = $this->id;
		}
		$parameter->domain_id = $domain_id;
		$parameter->parameter_key = $key;
		$parameter->parameter_value = $value;
		return $parameter->save();
	}

}