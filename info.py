# encoding: utf-8

# package info
name = 'symmetrics_config_german'
tags = ('magento', 'config', 'german', 'symmetrics')

# relations
requires = {
    'magento': '*',
    'symmetrics_module_impressum': '*',
    'symmetrics_module_invoicepdf': '*',
    'mc_module_locale_mage_community_de_de': '*',
}
excludes = {
}

# who is responsible for this package?
team_leader = {
    'Sergej Braznikov': 'sb@symmetrics.de'
}

# who should check this package in the first place?
maintainer = {
    'Eugen Gitin': 'eg@symmetrics.de'
}

# relative installation path (e.g. app/code/local)
install_path = ''

# additional infos
info = 'symmetrics Basiskonfiguration für deutsche Shops'
summary = '''
    symmetrics Basiskonfiguration für deutsche Shops
'''
license = 'AFL 3.0'
authors = {
    'Eugen Gitin': 'eg@symmetrics.de'
}
homepage = 'http://www.symmetrics.de'

# files this package depends on
depends_on_files = (
)
