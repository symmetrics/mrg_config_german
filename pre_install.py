import os
import sys
import string
import logging
import time
from xml.etree.ElementTree import parse

from symmetrics_saasrepo_installer import base, shortcuts


config = None # will be filled by main() with the current config dict
package_dir = os.path.dirname(os.path.abspath(__file__))
logger = logging.getLogger('symmetrics_config_german.pre_install')


def main(config_module, info_py):
    '''Is being called by the installer'''
    global config
    config = config_module
    
    customer = config['customer']
    magento = config['magento']
    
    data = dict(
        shop_name=magento['shop_name'],
        meta_description=magento['meta_description'],
        meta_keywords=magento['meta_keywords'],
        meta_robots=magento['meta_robots'],
        welcome_msg=magento['welcome_msg'],
        copyright=magento['copyright'],
        contact_name=magento['contact_addresses']['general']['name'],
        contact_email=magento['contact_addresses']['general']['name'],
        contact_sales_name=magento['contact_addresses']['sales']['name'],
        contact_sales_email=magento['contact_addresses']['sales']['email'],
        contact_support_name=magento['contact_addresses']['support']['name'],
        contact_support_email=magento['contact_addresses']['support']['email'],
        contact_custom1_name=magento['contact_addresses']['custom1']['name'],
        contact_custom1_email=magento['contact_addresses']['custom1']['email'],
        contact_custom2_name=magento['contact_addresses']['custom2']['name'],
        contact_custom2_email=magento['contact_addresses']['custom2']['email'],
        contact_recipient=customer['email'],
        email_domain=magento['email_domain'],
        invoice_address='%s\n'
                          '%s %s\n'
                          '%s\n'
                          '%s %s\n'
                          '%s' % (
                            customer['company_name'],
                            customer['firstname'], customer['lastname'],
                            customer['street'],
                            customer['zip'], customer['city'],
                            customer['country'],
                          ),
        zip=customer['zip'],
        city=customer['city'],
    )
    
    for key, val in data.iteritems():
        if type(val) is not basestring:
            data[key] = str(val)
    
    filename = os.path.join(package_dir, 'build', 'app', 'code', 'local',
                            'Symmetrics', 'ConfigGerman', 'etc', 'config.xml')
    tree = parse(filename)
    elements = tree.findall('default/config_german/default/*')
    
    for element in elements:
        if data.has_key(element.tag):
            element.text = data[element.tag]
    
    tree.write(filename, 'UTF-8')
