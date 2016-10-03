# execute 'apt-get update'
/*
exec { 'packageupdate':                    # exec resource named 'apt-update'
  command => '/opt/procbox/updatePackages.sh',
  require => File['updatePackages.sh']
}*/



# install apache2 package
package { 'apache2':
  ensure => installed,
}

# ensure apache2 service is running
service { 'apache2':
  ensure => running,
}


# install php5 package
package { 'php5':
  ensure => installed,
}


file { [  '/opt/procbox/', '/opt/procbox/rest/']:
  ensure => 'directory',
}
/*
file {
  'updatePackages.sh':
    require => File['/opt/procbox'],
    ensure => 'file',
    source => 'puppet:///updatePackages.sh',
    path => '/opt/procbox/updatePackages.sh',
    owner => 'root',
    group => 'root',
    mode  => '0744', # Use 0700 if it is sensitive
    notify => Exec['packageupdate'],
}*/
#Deploy directory is /opt/procbox

